<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Store;
use App\Http\Requests\User\Update;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use Upload;

    public function __construct()
    {
        // $this->middleware(['permission:settings-users-list|settings-users-create|settings-users-edit|settings-users-delete']);
    }

 
    public function index(Request $request)
    {

        $user = $request->user();
        $limit = $request->has('perPage') ? $request->perPage : 10;

        $users = User::query()
            ->with(['roles','address'])
            ->when($request->q, function ($query, $string) use ($request) {
                $query->search($request->q);
            })
            ->where('id', '<>', $user->id)
            ->applyFilters($request)
            ->latest()
            ->paginate($limit);

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $user = User::create($request->getUserPayload());

        if ($request->hasFile('avatar')) {
            $this->uploadAvatar($request, $user);
        }

        if ($request->address) {
            if ($request->hasAddress($request->address)) {
                $user->address()->create($request->getAddressPayload());
            }
        }

        if ($request->role_id) {
            $user->assignRole($request->role_id);
        }

        $user->companies()->sync($request->companies);

        return response()->json([
            'message' => 'User successfully added.',
        ]);
    }

  
    public function show(User $user)
    {
        return new UserResource($user->load('roles', 'companies:id', 'address'));
    }

    
    public function update(Update $request, User $user)
    {
        if ($request->hasFile('avatar')) {
            $this->uploadAvatar($request, $user);
        }

        $user->update($request->getUserPayload());

        if ($request->address) {
                $user->address()->updateOrCreate(
                    ['type' => 'home'],
                    $request->getAddressPayload()
                );
        }

        if ($request->role_id) {
            $user->syncRoles($request->role_id);
        }

        $user->companies()->sync($request->companies);

        return response()->json([
            'message' => 'User successfully updated.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        if ($user->hasRole('admin')) {
            return response()->json([
                'message' => 'You can not delete the only admin user.',
            ], 403);
        }

        $user->delete();

        $path = 'users/' . $user->id;

        Storage::deleteDirectory($path);

        return response()->json([
            'message' => 'User successfully deleted.',
        ]);
    }

    public function uploadAvatar(Request $request, $user)
    {

        if (isset($request->is_avatar_removed) && (bool) $request->is_avatar_removed) {
            $user->clearMediaCollection('avatar');
        }

        if ($user) {
            $user->clearMediaCollection('avatar');

            $fileName = 'avatar-' . $user->id . '.' . $request->avatar->getClientOriginalExtension();

            $user->addMediaFromRequest('avatar')
                ->usingFileName($fileName)
                ->toMediaCollection('avatar');
        }
    }
}
