<?php

use App\Models\Invoice;
use Illuminate\Support\Facades\Route;


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

// webhook lead receiver



Route::get('/pdf', function () {


    $invoice = Invoice::with([
        'company' => [
            'address',
        ],
        'customer' => [
            'billing',
            'currency',
        ]
    ])->find(1000);



    $pdfView = view('pdf.invoice', ['invoice' => $invoice])->render();

    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML($pdfView)->setPaper('a4', 'portrait');

    $fileName = $invoice->invoice_id . '.pdf';
    Storage::put(
        'invoices/' . $fileName,
        $pdf->output()
    );

});

Route::get('{any?}', function () {
    return view('application');
})->where('any', '.*');
