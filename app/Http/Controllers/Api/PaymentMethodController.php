<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PaymentMethod\Update;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentMethod\Store;
use App\Http\Resources\PaymentMethodResource;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->has('perPage') ? $request->perPage : 10;

        $customers = PaymentMethod::query()
            ->whereSearch($request)
            ->whereCompany()
            ->latest()
            ->paginate($limit);

        return PaymentMethodResource::collection($customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        //

        PaymentMethod::create($request->getPaymentMethodPayload());

        return response()->json([
            'message' => 'Payment Method created successfully.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //

        return new PaymentMethodResource($paymentMethod);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, PaymentMethod $paymentMethod)
    {
        //

        $paymentMethod->update($request->getPaymentMethodPayload());

        return response()->json([
            'message' => 'Payment Method updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentMethod $paymentMethod)
    {

        $paymentMethod->delete();

        return response()->json([
            'message' => 'Payment Method deleted successfully.',
        ]);
    }

    public function getPaymentMethods(Request $request)
    {
        $customers = PaymentMethod::query()
            ->whereCompany()
            ->where([
                'is_enabled' => true,
            ])
            ->latest()
            ->get();

        return PaymentMethodResource::collection($customers);
    }


    // updateStatus

    public function updateStatus(Request $request, $paymentMethodId)
    {
        $paymentMethod = PaymentMethod::query()
            ->whereCompany()
            ->where('id', $paymentMethodId)
            ->firstOrFail();

      
        $paymentMethod->update([
            'is_enabled' => $request->is_enabled,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Payment Method updated successfully',
        ], 200);
    }
}
