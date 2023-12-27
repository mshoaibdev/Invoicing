<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use App\Models\Estimate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Services\Store;

class ServiceController extends Controller
{
    //

    public function index()
    {
        return response()->json([
            'message' => 'Hello World!'
        ], 200);
    }


    public function store(Store $request)
    {
        $service = Service::create(array_merge($request->validated(), [
            'created_by' => auth()->user()->id,
        ]));

        return response()->json([
            'message' => 'Service created successfully!',
            'service' => $service
        ], 201);
    }

    // getCalendarEvents

    
    // update 

    public function update(Request $request, $id)
    {

        $service = Service::find($id);

        $service->update([
            'start_date' => date('Y-m-d H:i:s', strtotime($request->start)),
            'end_date' => date('Y-m-d H:i:s', strtotime($request->end))
        ]);

        return response()->json([
            'message' => 'Service updated successfully!',
            'service' => $service
        ], 201);
    }
}
