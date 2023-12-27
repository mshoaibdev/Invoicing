<?php

namespace App\Http\Controllers\Api;

use DatePeriod;
use Carbon\Carbon;
use App\Models\Lead;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Estimate;
use Carbon\CarbonInterval;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function getStats()
    {

        $isAdmin = auth()->user()->hasRole('Admin');

        $totalCustomers = Customer::query()
        ->when(!$isAdmin, function ($query) {
            $query->where('user_id', auth()->id());
        })->count();

        $totalInvoices = Invoice::query()
        ->when(!$isAdmin, function ($query) {
            $query->where('user_id', auth()->id());
        })->count();

        return response()->json([
            'totalCustomers' => $totalCustomers,
            'totalInvoices' => $totalInvoices,
        ]);

    }

}
