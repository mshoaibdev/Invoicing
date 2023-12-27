<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['permission:settings-roles-list|settings-roles-create|settings-roles-edit|settings-roles-delete']);
    }

    /**
     * Display a listing of Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::with('permissions')
            ->when($request->q, function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->q.'%');
            })
            ->latest()->when($request->perPage, function ($query, $perPage) {
                return $query->paginate($perPage);
            }, function ($query) {
                return $query->get();
            });

        return RoleResource::collection($roles);
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|unique:roles',
        ]);
        $role = Role::create($request->except('permissions'));
        $permissions = $request->input('permissions') ? $request->input('permissions') : [];
        $role->givePermissionTo($permissions);

        return response()->json(['status' => true, 'message' => 'Role successfully saved.']);
    }

    /**
     * Update Role in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,'.$role->id,
        ]);

        $role->update($request->except('permissions'));
        $permissions = $request->input('permissions') ? $request->input('permissions') : [];

        // dd($permissions);
        $role->syncPermissions($permissions);

        return response()->json(['status' => true, 'message' => 'Role successfully updated.']);
    }

    public function show(Role $role)
    {
        $role->load('permissions');

        return new RoleResource($role);
    }

    /**
     * Remove Role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json(['status' => true, 'message' => 'Role successfully deleted.']);
    }

    /**
     * Delete all selected Role at once.
     */
    public function massDestroy(Request $request)
    {
        Role::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

    public function userRoles()
    {
        return auth()->user()->getRoleNames();
    }
}
