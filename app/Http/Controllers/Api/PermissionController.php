<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['permission:settings-permissions-list|settings-permissions-create|settings-permissions-edit|settings-permissions-delete']);
    }

    /**
     * Display a listing of Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissions = Permission::query()
            ->when($request->q, function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->q.'%');
            })
            ->orderBy('name')->when($request->perPage, function ($query, $perPage) {
                return $query->paginate($perPage);
            }, function ($query) {
                return $query->get();
            });

        return PermissionResource::collection($permissions);
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|unique:permissions',
        ]);
        Permission::create($request->all());

        return response()->json(['status' => true, 'message' => 'Permission successfully saved.']);
    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|max:100|unique:permissions,name,'.$permission->id,
        ]);
        $permission->update($request->all());

        return response()->json(['status' => true, 'message' => 'Permission successfully updated.']);
    }

    /**
     * Remove Permission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return response()->json(['status' => true, 'message' => 'Permission successfully deleted.']);
    }

    public function show(Permission $permission)
    {
        return new PermissionResource($permission);
    }

    /**
     * Delete all selected Permission at once.
     */
    public function massDestroy(Request $request)
    {
        Permission::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

    public function userPermissions()
    {
        return auth()->user()->getAllPermissions()->pluck('name');
    }
}
