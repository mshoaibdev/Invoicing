<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Group\Update;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Requests\Group\Store;
use App\Http\Controllers\Controller;
use App\Http\Resources\GroupResource;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $groups = Group::query()
        ->when($request->q, function ($query, $string) use ($request) {
            $query->search($request->q);
        })
        ->when($request->perPage, function ($query, $perPage) {
            return $query->paginate($perPage);
        }, function ($query) {
            return $query->get();
        });

        return GroupResource::collection($groups); 

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        
        $group = Group::create($request->validated());

        return response()->json([
            'message' => 'Group created successfully',
            'data' => new GroupResource($group),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        //

        return new GroupResource($group);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, Group $group)
    {
        
        $group->update($request->validated());

        return response()->json([
            'message' => 'Group updated successfully',
            'data' => new GroupResource($group),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {

        $group->delete();

        return response()->json([
            'message' => 'Group deleted successfully',
        ], 200);
    }
}
