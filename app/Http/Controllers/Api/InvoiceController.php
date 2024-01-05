<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use App\Models\Invoice;
use App\Models\Setting;
use App\Mail\NewInvoice;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Srmklive\PayPal\Facades\PayPal;
use App\Http\Controllers\Controller;
use App\Http\Requests\Invoice\Store;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Invoice\Update;
use App\Http\Requests\InvoiceRequest;
use App\Http\Resources\InvoiceResource;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->has('perPage') ? $request->perPage : 10;

        $invoices = Invoice::query()
            ->with(['customer', 'company', 'paymentMethod'])
            ->whereSearch($request)
            ->whereCreator()
            ->whereCompany()
            ->applyFilters($request)
            ->latest()
            ->paginate($limit);

        return InvoiceResource::collection($invoices);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {

        $invoice = Invoice::create($request->getInvoicePayload());

        $invoice->load([
            'company' => [
                'address' => [
                    'country',
                ],
            ],
            'paymentMethod',
            'customer' => [
                'billing',
                'currency',
            ]
        ]);

        if ($invoice->paymentMethod->name == 'PayPal') {
            $this->createPaypalInvoice($invoice);
        }

        if($request->status == "Sent"){
            $this->sendInvoice($request, $invoice->id);
        }

        $this->saveInvoicePdf($invoice);

        return response()->json([
            'message' => 'Invoice created successfully.',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $invoice->load(['customer' => ['billing','currency']]);

        return new InvoiceResource($invoice);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, Invoice $invoice)
    {

        $invoice->update($request->getInvoicePayload());

        $invoice->load([
            'company' => [
                'address',
            ],
            'customer' => [
                'billing',
                'currency',
            ]
        ]);

        $this->saveInvoicePdf($invoice);

        return response()->json([
            'message' => 'Invoice updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return response()->json([
            'message' => 'Invoice deleted successfully.',
        ]);
    }

    // updateStatus

    public function updateStatus(Request $request, $invoiceId)
    {

        $invoice = Invoice::find($invoiceId);

        $invoice->update([
            'in_progress' => $request->status,
        ]);

        return response()->json([
            'message' => 'Invoice status updated successfully.',
        ]);
    }


    // invoices count by status
    public function invoicesCountByStatus(Request $request)
    {
        // invoices count by status for last week 
        $invoices = Invoice::query()
            ->selectRaw('count(*) as count, status')
            ->whereBetween('created_at', [now()->subWeek(), now()])
            ->groupBy('status')
            ->get();


        return response()->json([
            'data' => $invoices,
        ]);
    }


    // create paypal invoice 

    public function createPaypalInvoice($invoice)
    {


        // set paypal config
        $this->setPaypalConfig($invoice->payment_method_id);


        $provider = new PayPalClient;
        $provider = PayPal::setProvider();
        $provider->getAccessToken();

        $provider->setCurrency($invoice->customer->currency->code);
        $provider->setRequestHeader('Prefer', 'return=representation');


        $items = [];
        foreach ($invoice->items as $product) {
            $items[] = [
                'name' => $product['description'],
                'category' => 'DIGITAL_GOODS',
                'unit_amount' => [
                    'currency_code' => $invoice->customer->currency->code,
                    'value' => $product['total'],
                ],
                'quantity' => $product['quantity'],
            ];
        }

        $data = [
            'items' => $items,
            'detail' => [
                'invoice_number' => $invoice->invoice_id,
                'invoice_date' => $invoice->invoice_date,
                'currency_code' => $invoice->customer->currency->code,
                'note' => $invoice->note,
                'payment_term' => [
                    'term_type' => 'DUE_ON_DATE_SPECIFIED',
                    'due_date' => $invoice->due_date,
                ],
            ],
            'invoicer' => [
                'name' => [
                    'given_name' => $invoice->company->name,
                    // 'surname' => Auth()->user()->last_name,
                ],
                'address' => [
                    'address_line_1' => $invoice->company->address->address_street_1 ?? '',
                    'postal_code' => $invoice->company->address->zip ?? '',
                ],
                'email_address' => $invoice->company->email,
            ],
            'primary_recipients' => [
                [
                    'name' => [
                        'given_name' => $invoice->customer->name,
                    ],
                    'address' => [
                        'address_line_1' => $invoice->customer->address->address_street_1 ?? '',
                        'postal_code' => $invoice->customer->address->zip ?? '',
                    ],
                    'billing_info' => [
                        'email_address' => $invoice->customer->email,
                    ],

                ],
            ],
            'billing_info' => [
                'email_address' => $invoice->customer->email,
            ],
            'breakdown' => [
                'item_total' => [
                    'value' => $invoice->subtotal,
                ],
                'tax_total' => [
                    'value' => $invoice->tax_amount ?? 0,
                ],
            ],
            'tax_inclusive' => false,
            'logo_url' => $invoice->company->logo_url,
            'total_amount' => [
                'value' => $invoice->total,
            ],
        ];


        $response = $provider->createInvoice($data);

        // check for error key
        if (array_key_exists('error', $response)) {

            return response()->json([
                'message' => $response['error']['message'],
            ], 500);
        }

        $invoice->update([
            'payment_response' => $response,
        ]);


        return $response;

    }


    // save invoice pdf

    public function saveInvoicePdf($invoice): void
    {

        $pdfView = view('pdf.invoice', ['invoice' => $invoice])->render();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($pdfView)->setPaper('a4', 'portrait');

        $fileName = $invoice->invoice_id . '.pdf';

        $path = 'invoices/' . $invoice->customer->uuid . '/' . $fileName;

        // check if file exists
        if (\Storage::exists($path)) {
            \Storage::delete($path);
        }

        \Storage::put(
            $path,
            $pdf->output()
        );

    }



    // sendInvoice

    public function sendInvoice(Request $request, $invoiceId)
    {

        $companyMailConfig = Setting::query()
            ->whereCompany()
            ->where('group', 'mail')
            ->pluck('value', 'key');

        if (empty($companyMailConfig) || count($companyMailConfig) == 0) {
            return response()->json([
                'message' => 'Please configure mail settings for this company in the settings.',
            ], 422);
        }

        $invoice = Invoice::query()
            ->with(['paymentMethod', 'company'])
            ->whereCompany()
            ->where('id', $invoiceId)
            ->first();
        
        $data = [
            'status' => 'Sent',
        ];

        if ($invoice->paymentMethod && $invoice->paymentMethod->name == 'PayPal') {

            $paypalResponse = $this->sendPaypalInvoice($request, $invoice);

            if (is_array($paypalResponse) && array_key_exists('error', $paypalResponse)) {
                return response()->json([
                    'message' => json_decode($paypalResponse['error'], true)['details'][0]['description'],
                ], 500);
            }


            $data['payment_response'] = json_decode($paypalResponse, true)['href'];
        }

        $invoice->update($data);

        config([
            'mail.driver' => $companyMailConfig['mail_driver'],
            'mail.host' => $companyMailConfig['mail_host'],
            'mail.port' => $companyMailConfig['mail_port'],
            'mail.encryption' => $companyMailConfig['mail_encryption'],
            'mail.username' => $companyMailConfig['mail_username'],
            'mail.password' => $companyMailConfig['mail_password'],
            'mail.from.address' => $companyMailConfig['mail_from_address'],
            'mail.from.name' => $invoice->company->name,
        ]);

        $subject = $request->subject;
        $body = $this->processBody($request->body, $invoice);


        Mail::to($invoice->customer->email)->send(new NewInvoice($invoice, $subject, $body));

        return response()->json([
            'message' => 'Invoice sent successfully.',
        ]);
    }


    public function sendPaypalInvoice(Request $request, Invoice $invoice)
    {

        // set paypal config
        $this->setPaypalConfig($invoice->payment_method_id);

        $provider = new PayPalClient;
        $provider = PayPal::setProvider();
        $provider->getAccessToken();


        return $provider->sendInvoice($invoice->payment_response['id']);
    }


    public function processBody($body, $invoice)
    {

        $body = str_replace('{COMPANY_NAME}', $invoice->company->name, $body);
        $body = str_replace('{PAY_LINK}', '<a href="' . $invoice->payment_link . '" target="_blank">Pay Now</a>', $body);

        return $body;
    }

    // set paypal config 

    public function setPaypalConfig($paymentMethodId)
    {

        $companyPaypalMethod = PaymentMethod::query()
            ->whereCompany()
            ->where('id', $paymentMethodId)
            ->first();

        if (empty($companyPaypalMethod)) {
            return response()->json([
                'message' => 'Please configure PayPal settings for this company in the settings.',
            ], 422);
        }

        // get paypal settings
        $secretKey = "";
        $clientId = "";

        if ($companyPaypalMethod->mode == 'sandbox') {
            $secretKey = $companyPaypalMethod->sandbox_secret;
            $clientId = $companyPaypalMethod->sandbox_identifier;
        } else {
            $secretKey = $companyPaypalMethod->live_secret;
            $clientId = $companyPaypalMethod->live_identifier;
        }

        // update paypal config
        config([
            'paypal.mode' => $companyPaypalMethod->mode,
            'paypal.sandbox.client_id' => $clientId,
            'paypal.sandbox.client_secret' => $secretKey,
            'paypal.live.client_id' => $clientId,
            'paypal.live.client_secret' => $secretKey,
        ]);

    }
}
