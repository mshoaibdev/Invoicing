<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function getStats(Request $request)
    {

        $isAdmin = auth()->user()->hasRole('Admin');

        $totalCustomers = Customer::query()
        ->whereCompany()
        ->whereCreator()
        ->count();

        $totalInvoices = Invoice::query()
        ->whereCompany()
        ->whereCreator()
        ->count();


        $totalDraftInvoices = Invoice::query()
        ->whereCompany()
        ->whereCreator()
        ->where('status', 'Draft')
        ->count();

        $currentCompany = Company::with('currency')->find($request->header('company'));

        $getMonthlySales = $this->getMonthlySales();

        return response()->json([
            'companyCurrency' => $currentCompany->currency ?? ['code' => 'USD', 'symbol' => '$'],
            'totalCustomers' => $totalCustomers,
            'totalInvoices' => $totalInvoices,
            'monthlySales' => $getMonthlySales,
            'totalDraftInvoices' => $totalDraftInvoices,
        ]);

    }


    // monthly sales

    public function getMonthlySales()
    {
        $isAdmin = auth()->user()->hasRole('Admin');

        $invoices = Invoice::query()
        ->whereCreator()
        ->whereCompany()
        ->where('status', 'Paid')
        ->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
        ->get()
        ->groupBy(function ($invoice) {
            return Carbon::parse($invoice->created_at)->format('m');
        });

        $months = collect([
            '01' => 'Jan',
            '02' => 'Feb',
            '03' => 'Mar',
            '04' => 'Apr',
            '05' => 'May',
            '06' => 'Jun',
            '07' => 'Jul',
            '08' => 'Aug',
            '09' => 'Sep',
            '10' => 'Oct',
            '11' => 'Nov',
            '12' => 'Dec',
        ]);

        $monthlySales = $months->map(function ($month, $key) use ($invoices) {
            return [
                'month' => $month,
                'sales' => $invoices->has($key) ? $invoices[$key]->sum('total') : 0,
            ];
        });

        return $monthlySales;
    }

}
