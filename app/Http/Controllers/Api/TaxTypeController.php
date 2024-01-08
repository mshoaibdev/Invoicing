<?php

namespace App\Http\Controllers\Api;

use App\Models\TaxType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaxType\Store;
use App\Http\Requests\TaxType\Update;
use App\Http\Resources\TaxTypeResource;

class TaxTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->has('perPage') ? $request->perPage : 10;

        $taxTypes = TaxType::query()
            ->whereSearch($request)
            ->whereCompany()
            ->latest()
            ->paginate($limit);

        return TaxTypeResource::collection($taxTypes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        //

        TaxType::create($request->getTaxTypePayload());

        return response()->json([
            'message' => 'Tax Type created successfully.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(TaxType $taxType)
    {
        return new TaxTypeResource($taxType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, TaxType $taxType)
    {

        $taxType->update($request->getTaxTypePayload());

        return response()->json([
            'message' => 'Tax Type updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaxType $taxType)
    {

        $taxType->delete();

        return response()->json([
            'message' => 'Tax Type deleted successfully.',
        ]);
    }

    public function getTaxTypes(Request $request)
    {
        $customers = TaxType::query()
            ->whereCompany()
            ->latest()
            ->get();

        return TaxTypeResource::collection($customers);
    }

   
}
