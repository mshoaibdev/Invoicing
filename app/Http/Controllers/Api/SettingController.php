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
    public function index(Request $request)
    {
        return Setting::getSettings($request->keys, $request->header('company'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Setting::setSettings($request->except('group'), $request->header('company'), $request->group);

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
        Setting::setSettings($request->except('group'), $request->header('company'), $request->group);

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

    public function getSetting(Request $request)
    {
        return Setting::getSetting($request->keys, $request->header('company'));

    }
    
}
