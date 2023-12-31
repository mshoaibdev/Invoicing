<?php

namespace App\Http\Controllers;

use NumberFormatter;
use App\Models\Invoice;
use App\Models\Setting;
use App\Mail\NewPayment;
use App\Mail\InvoicePaid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ProcessPayment;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class PaymentController extends Controller
{
    //

    // paymentForm

    public function paymentForm(Request $request, $invoiceId)
    {
        $invoice = Invoice::with([
            'company' => [
                'address' => [
                    'country',
                ],
            ],
            'paymentMethod',
            'customer' => [
                'currency',
            ]
        ])->where('uuid', $invoiceId)->firstOrFail();

        $formatter = new NumberFormatter($invoice->customer->currency->code, NumberFormatter::CURRENCY);

        // check if invoice is already paid

        if ($invoice->status == 'Paid') {
            return redirect()->route('payment.success', ['invoiceId' => $invoice->uuid, 'transactionId' => $invoice->payments->first()->transaction_id, 'message' => 'Invoice already paid']);
        }


        // check fro payment method keys
        if ($invoice->paymentMethod->mode == 'sandbox') {
            if (!$invoice->paymentMethod->sandbox_identifier || !$invoice->paymentMethod->sandbox_secret) {
                return redirect()->route('payment.failed', ['invoiceId' => $invoice->uuid, 'message' => 'Payment method not configured']);
            }
        } else {
            if (!$invoice->paymentMethod->live_identifier || !$invoice->paymentMethod->live_secret) {
                return redirect()->route('payment.failed', ['invoiceId' => $invoice->uuid, 'message' => 'Payment method not configured']);
            }
        }

        return view('payment-form', ['invoice' => $invoice, 'formatter' => $formatter]);
    }


    // processPayment

    public function processPayment(ProcessPayment $request)
    {
        $cardNumber = $request->input('card_number');
        $expirationDate = $request->input('card_expiry');
        $cvv = $request->input('card_cvv');
        $cardName = $request->input('card_name');
        $invoiceId = $request->input('invoice');

        $invoice = Invoice::with([
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
        ])->where('uuid', $invoiceId)->firstOrFail();

        $amount = $invoice->total;


        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(
            $invoice->paymentMethod->mode == 'sandbox' ? $invoice->paymentMethod->sandbox_identifier : $invoice->paymentMethod->live_identifier
        );
        $merchantAuthentication->setTransactionKey(
            $invoice->paymentMethod->mode == 'sandbox' ? $invoice->paymentMethod->sandbox_secret : $invoice->paymentMethod->live_secret
        );

        // Set the transaction's refId
        $refId = 'ref' . time();

        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($cardNumber);
        $creditCard->setExpirationDate($expirationDate);
        $creditCard->setCardCode($cvv);

        // Add the payment data to a paymentType object
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        $invoiceNumber = $invoice->invoice_id;

        // Create order information
        $order = new AnetAPI\OrderType();
        $order->setInvoiceNumber($invoiceNumber);
        $order->setDescription('Payment for ' . $invoice->company->name . ' invoice');

        // Set the customer's Bill To address
        $customerAddress = new AnetAPI\CustomerAddressType();
        $customerAddress->setFirstName(
            $cardName
        );
        // $customerAddress->setLastName(
        //     $cardName
        // );
        // $customerAddress->setCompany("Souveniropolis");
        // $customerAddress->setAddress("14 Main Street");
        // $customerAddress->setCity("Pecan Springs");
        // $customerAddress->setState("TX");
        // $customerAddress->setZip("44628");
        // $customerAddress->setCountry("USA");

        // Set the customer's identifying information
        // $customerData = new AnetAPI\CustomerDataType();
        // $customerData->setType("individual");
        // $customerData->setId("99999456654");
        // $customerData->setEmail("EllenJohnson@example.com");

        // Add values for transaction settings
        // $duplicateWindowSetting = new AnetAPI\SettingType();
        // $duplicateWindowSetting->setSettingName("duplicateWindow");
        // $duplicateWindowSetting->setSettingValue("60");

        // Add some merchant defined fields. These fields won't be stored with the transaction,
        // but will be echoed back in the response.


        // Create a TransactionRequestType object and add the previous objects to it
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($amount);
        $transactionRequestType->setOrder($order);
        $transactionRequestType->setPayment($paymentOne);
        $transactionRequestType->setBillTo($customerAddress);
        // $transactionRequestType->setCustomer($customerData);
        // $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);

        // Assemble the complete transaction request
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);

        // Create the controller and get the response
        $controller = new AnetController\CreateTransactionController($request);

        // check if the environment is sandbox or production
        if ($invoice->paymentMethod->mode == 'sandbox') {
            // Set the environment to sandbox
            $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
        } else {
            // Set the environment to production
            $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);

        }


        if ($response != null) {
            // Check to see if the API request was successfully received and acted upon
            if ($response->getMessages()->getResultCode() == "Ok") {
                // Since the API request was successful, look for a transaction response
                // and parse it to display the results of authorizing the card
                $tresponse = $response->getTransactionResponse();


                if ($tresponse != null && $tresponse->getMessages() != null) {

                    $companyMailConfig = Setting::query()
                        ->where('company_id', $invoice->company->id)
                        ->where('group', 'mail')
                        ->pluck('value', 'key');


                    if ($companyMailConfig->isNotEmpty()) {

                        $this->setSmtpConfig($companyMailConfig, $invoice->company->name);

                        Mail::to($invoice->customer->email)->bcc(config('app.email'))->send(new InvoicePaid($invoice));
                    }


                    $invoice->payments()->create([
                        'amount' => $amount,
                        'order_details' => 'Payment for invoice ' . $invoice->invoice_id,
                        'transaction_id' => $tresponse->getTransId(),
                        'payment_method_id' => $invoice->paymentMethod->id,
                        'currency_id' => $invoice->customer->currency->id,
                        'payment_date' => now(),
                        'company_id' => $invoice->company->id,
                        'payment_response' => json_encode($tresponse),
                    ]);

                    $invoice->update([
                        'status' => 'Paid',
                        'is_paid' => true,
                        'paid_date' => now(),
                    ]);

                    return redirect()->route('payment.success', ['invoiceId' => $invoice->uuid, 'transactionId' => $tresponse->getTransId(), 'message' => 'Payment successful']);


                } else {
                    if ($tresponse->getErrors() != null) {

                        return redirect()->route('payment.failed', ['invoiceId' => $invoice->uuid, 'message' => $tresponse->getErrors()[0]->getErrorText()]);
                    } else {
                        return redirect()->route('payment.failed', ['invoiceId' => $invoice->uuid, 'message' => 'Unknown error']);
                    }
                }


                // Or, print errors if the API request wasn't successful
            } else {
                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getErrors() != null) {

                    return redirect()->route('payment.failed', ['invoiceId' => $invoice->uuid, 'message' => $tresponse->getErrors()[0]->getErrorText()]);
                } else {
                    return redirect()->route('payment.failed', ['invoiceId' => $invoice->uuid, 'message' => 'Unknown error']);
                }
            }
        } else {
            return redirect()->route('payment.failed', ['invoiceId' => $invoice->uuid, 'message' => 'Unknown error']);
        }

    }

    public function setSmtpConfig($companyMailConfig, $companyName)
    {

        config([
            'mail.driver' => $companyMailConfig['mail_driver'],
            'mail.host' => $companyMailConfig['mail_host'],
            'mail.port' => $companyMailConfig['mail_port'],
            'mail.encryption' => $companyMailConfig['mail_encryption'],
            'mail.username' => $companyMailConfig['mail_username'],
            'mail.password' => $companyMailConfig['mail_password'],
            'mail.from.address' => $companyMailConfig['mail_from_address'],
            'mail.from.name' => $companyName,
        ]);

    }
}
