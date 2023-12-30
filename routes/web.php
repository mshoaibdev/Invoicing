<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

use function Spatie\LaravelPdf\Support\pdf;

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

    return pdf('pdf')
    ->view('pdf')
    ->name('invoice-2023-04-10.pdf');

});

Route::get('{any?}', function () {
    return view('application');
})->where('any', '.*');
