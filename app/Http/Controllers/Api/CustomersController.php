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
        $isAdmin = auth()->user()->hasRole('Admin');
        $customers = Customer::query()
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

        return CustomerResource::collection($customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {

        Customer::create(array_merge($request->validated(), [
            'user_id' => auth()->id(),
        ]));

        return response()->json([
            'message' => 'Customer created successfully.',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {

        return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, Customer $customer)
    {
        
        $customer->update($request->validated());

        return response()->json([
            'message' => 'Customer updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
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

        Customer::whereIn('id', $ids)->delete();

        return response()->json([
            'message' => 'Customers deleted successfully.',
        ]);
    }
}
