<?php

namespace App\Http\Controllers\Api;

use App\Models\Invoice;
use App\Mail\NewInvoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Invoice\Store;
use App\Http\Requests\Invoice\Update;
use App\Http\Requests\InvoiceRequest;
use App\Http\Resources\InvoiceResource;
use Srmklive\PayPal\Facades\PayPal;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        $invoices = Invoice::query()
            ->with(['customer', 'user'])
            ->when($request->q, function ($query) use ($request) {
                $query->search($request->q);
            })
            ->when(!auth()->user()->hasRole('Admin'), function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->applyFilters($request)
            ->latest()
            ->when($request->perPage, function ($query, $perPage) {
                return $query->paginate($perPage);
            }, function ($query) {
                return $query->get();
            });

        return InvoiceResource::collection($invoices);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {

        $invoice = Invoice::create(array_merge($request->validated(), [
            'user_id' => auth()->id(),
        ]));


        $this->createPaypalInvoice($invoice);

        // Mail::to($invoice->customer->email)->send(new NewInvoice($invoice));

        return response()->json([
            'message' => 'Invoice created successfully.',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $invoice->load(['customer']);

        return new InvoiceResource($invoice);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, Invoice $invoice)
    {

        $invoice->update($request->validated());

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

        $provider = new PayPalClient;
        $provider = PayPal::setProvider();
        $provider->getAccessToken();

        // return $provider->showInvoiceDetails('INV2-TKZ3-SPZ3-HTDZ-RM27');


        $items = [];
        foreach ($invoice->items as $product) {
            $items[] = [
                'name' => $product['description'],
                'category' => 'DIGITAL_GOODS',
                'unit_amount' => [
                    'currency_code' => $invoice->currency,
                    'value' => $product['total'],
                ],
                'quantity' => $product['quantity'],
            ];
        }

        $data = [
            'items' => $items,
            'detail' => [
                'invoice_number' => $invoice->invoice_id . '-' . time(),
                'reference' => 'deal-ref',
                'invoice_date' => $invoice->invoice_date,
                'currency_code' => $invoice->currency,
                'note' => $invoice->note,
                'payment_term' => [
                    'term_type' => 'DUE_ON_DATE_SPECIFIED',
                    'due_date' => $invoice->due_date,
                ],
            ],
            'invoicer' => [
                'name' => [
                    'given_name' => Auth()->user()->fist_name,
                    'surname' => Auth()->user()->last_name,
                ],
                'address' => [
                    'address_line_1' => Auth()->user()->address,
                    'postal_code' => Auth()->user()->zip,
                    'country_code' => Auth()->user()->country,
                ],
                'email_address' => Auth()->user()->email,
            ],
            'primary_recipients' => [
                [
                    'name' => [
                        'given_name' => $invoice->customer->name,
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
                    'currency_code' => $invoice->currency,
                    'value' => $invoice->subtotal,
                ],
                'tax_total' => [
                    'currency_code' => $invoice->currency,
                    'value' => $invoice->tax_amount ?? 0,
                ],
            ],
            'tax_inclusive' => false,
            'logo_url' => asset('assets/images/logo.png'),
            'total_amount' => [
                'currency_code' => $invoice->currency,
                'value' => $invoice->total,
            ],
        ];


        $response = $provider->createInvoice($data);

        $invoiceId = $response['href'];

        $invoiceId = explode('/', $invoiceId);

        $invoiceId = end($invoiceId);

        $paypalInvoice = $provider->showInvoiceDetails($invoiceId);


        $invoice->update([
            'payment_response' => $response,
            'invoice_link' => $paypalInvoice['detail']['metadata']['recipient_view_url']
        ]);


        return $paypalInvoice;

    }
}
