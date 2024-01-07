<?php

use App\Models\Invoice;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/pdf', function () {


    $invoice = Invoice::with([
        'company' => [
            'address',
        ],
        'paymentMethod',
        'customer' => [
            'billing',
            'currency',
        ]
    ])->find(1101);


    $pdfView = view('test', ['invoice' => $invoice])->render();

    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML($pdfView)->setPaper('a4', 'portrait');
    return $pdf->stream();
    // $pdfContent = $pdf->output();

});



// invoice.pay
Route::get('/invoice/pay/{invoiceId}', [PaymentController::class, 'paymentForm'])->name('invoice.pay');
// process-payment
Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('process.payment');

// success
Route::get('/success', function () {
    return view('success');
})->name('payment.success');

// failed
Route::get('/failed', function () {
    return view('failed');
})->name('payment.failed');

Route::get('{any?}', function () {
    return view('application');
})->where('any', '.*');
