<?php

use App\Http\Controllers\PagesController;
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




Route::controller(PagesController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/app-development', 'appDevelopment')->name('app-development');
    Route::get('/blockchain-game-development', 'blockchainGameDevelopment')->name('blockchain-game-development');
    Route::get('/business-process-outsourcing', 'businessProcessOutsourcing')->name('business-process-outsourcing');
    Route::get('/cloud-team', 'cloudTeam')->name('cloud-team');
    Route::get('/digital-commerce', 'digitalCommerce')->name('digital-commerce');
    Route::get('/e-commerce-development', 'eCommerceDevelopment')->name('e-commerce-development');
    Route::get('/game-app-development', 'gameAppDevelopment')->name('game-app-development');
    Route::get('/quality-assurance', 'qualityAssurance')->name('quality-assurance');
    Route::get('/security', 'security')->name('security');
    Route::get('/user-experience', 'userExperience')->name('user-experience');
    Route::get('/packages', 'packages')->name('packages');

    // contact form
    Route::post('/contact', 'contactForm')->name('contact-form');
});


Route::get('{any?}', function () {
    return view('application');
})->where('any', '.*');
