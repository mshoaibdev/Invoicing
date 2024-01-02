<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\CalendarController;
use App\Http\Controllers\Api\BootstrapController;
use App\Http\Controllers\Api\CountriesController;
use App\Http\Controllers\Api\CustomersController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\CurrenciesController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('user', [AuthController::class, 'user'])->name('user');

    Route::get('/dashboard/stats', [DashboardController::class, 'getStats'])->name('dashboard.stats');
    Route::get('/account', [AccountController::class, 'account'])->name('account');
    Route::put('/account/password', [AccountController::class, 'updateAccountPassword'])->name('account.password');
    Route::put('/account/update', [AccountController::class, 'updatePersonalProfile'])->name('account.personal');
    Route::get('/settings/single/{key}', [SettingController::class, 'getSetting'])->name('settings.get');

    // update customer status
    Route::post('/customers/status/{id}', [CustomersController::class, 'updateStatus'])->name('customers.status');
    Route::post('/projects/status/{id}', [ProjectController::class, 'updateStatus'])->name('projects.status');
    Route::post('/customers/multiple/delete', [CustomersController::class, 'deleteMultiple'])->name('customers.delete');
    Route::get('/calendar/events', [CalendarController::class, 'getCalendarEvents'])->name('calendar.events');
    Route::get('/bootstrap', BootstrapController::class);

    Route::get('/countries', CountriesController::class);
    Route::get('/currencies', CurrenciesController::class);

    // fetch companies
    Route::get('/fetch-companies', [CompanyController::class, 'getCompanies'])->name('fetch-companies');

    // fetch customers
    Route::get('/fetch-customers', [CustomersController::class, 'getCustomers'])->name('fetch-customers');


    Route::get('/current-company', [CompanyController::class, 'currentCompany'])->name('current-company');

    // send invoice
    Route::post('/invoices/send/{id}', [InvoiceController::class, 'sendInvoice'])->name('invoices.send');
    


    Route::apiResources([
        'settings' => SettingController::class,
        'users' => UserController::class,
        'roles' => RoleController::class,
        'permissions' => PermissionController::class,
        'customers' => CustomersController::class,
        'invoices' => InvoiceController::class,
        'projects' => ProjectController::class,
        'companies' => CompanyController::class,
    ]);

});
