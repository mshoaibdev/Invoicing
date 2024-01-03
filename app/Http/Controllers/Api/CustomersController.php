<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Store;
use Illuminate\Support\Facades\Event;
use App\Http\Requests\Customer\Update;
use OwenIt\Auditing\Events\AuditCustom;
use App\Http\Resources\CustomerResource;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $limit = $request->has('perPage') ? $request->perPage : 10;

        $customers = Customer::query()
            ->with(['billing', 'currency'])
            ->when($request->q, function ($query) use ($request) {
                $query->search($request->q);
            })
            ->whereCompany()
            ->applyFilters($request)
            ->latest()
            ->paginate($limit);

        return CustomerResource::collection($customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {

        $customer = Customer::create($request->getCustomerPayload());

        if ($request->billing) {
            if ($request->hasAddress($request->billing)) {
                $customer->addresses()->create($request->getBillingAddress());
            }
        }

        return response()->json([
            'message' => 'Customer created successfully.',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {

        return new CustomerResource($customer->load(['billing', 'currency']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, Customer $customer)
    {

        $customer->update($request->getCustomerPayload());

        if ($request->billing) {
            if ($request->hasAddress($request->billing)) {
                $customer->addresses()->updateOrCreate(
                    ['type' => 'billing'],
                    $request->getBillingAddress()
                );
            }
        }

        return response()->json([
            'message' => 'Customer updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {

        $customer->invoices()->delete();
        $customer->addresses()->delete();
        $customer->delete();

        return response()->json([
            'message' => 'Customer deleted successfully.',
        ]);
    }

    // updateStatus

    public function updateStatus(Request $request, $customerId)
    {
        
        $customer = Customer::find($customerId);

        $customer->update([
            'in_progress' => $request->status,
        ]);

        return response()->json([
            'message' => 'Customer status updated successfully.',
        ]);
    }


    // customers count by status
    public function customersCountByStatus(Request $request)
    {
        // customers count by status for last week 
        $customers = Customer::query()
            ->selectRaw('count(*) as count, status')
            ->whereBetween('created_at', [now()->subWeek(), now()])
            ->groupBy('status')
            ->get();


        return response()->json([
            'data' => $customers,
        ]);
    }

    // deleteMultiple

    public function deleteMultiple(Request $request)
    {
        $ids = $request->ids;

        $customers = Customer::whereIn('id', $ids)->get();

        // deleted related address, invoices

        foreach ($customers as $customer) {

            $customer->invoices()->delete();
            $customer->addresses()->delete();
            $customer->delete();
        }


        return response()->json([
            'message' => 'Customers deleted successfully.',
        ]);
    }

    // getCustomers

    public function getCustomers(Request $request)
    {
        $customers = Customer::query()
            ->with(['billing', 'currency'])
            ->whereCompany()
            ->latest()
            ->get();

        return CustomerResource::collection($customers);
    }

  
}
