<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::getAll();

        return new SettingResource($settings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }

        return response()->json([
            'message' => 'Settings successfully updated ',
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->all();

        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }

        return response()->json([
            'message' => 'Settings successfully updated ',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }

    // getSetting

    public function getSetting($key)
    {
        $setting = Setting::get($key);

        return response()->json([
            'data' => $setting,
        ], 200);
    }
}
