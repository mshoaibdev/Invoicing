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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $users = User::query()
            ->with(['roles'])
            ->when($request->q, function ($query, $string) use ($request) {
                $query->search($request->q);
            })
            ->applyFilters($request)
            ->when($request->perPage, function ($query, $perPage) {
                return $query->paginate($perPage);
            }, function ($query) {
                return $query->get();
            });

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
        $data = $request->validated();
        $user = User::create($data);

        if ($request->hasFile('avatar')) {

            $path = 'users/' . $user->id;

            $fileName = $this->uploadAvatarAndResize($request->avatar, $path);
            $data['avatar'] = $fileName;
        }


        if ($request->role_id) {
            $user->assignRole($request->role_id);
        }

        return response()->json([
            'data' => $user,
            'message' => 'User successfully added.',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user->load('roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, User $user)
    {
        $data = $request->validated();
        if ($request->hasFile('avatar_new')) {

            $path = 'users/' . $user->id;

            Storage::delete($path . '/' . $user->avatar_new);
            $fileName = $this->uploadAvatarAndResize($request->avatar_new, $path);
            $data['avatar'] = $fileName;
        }

        $user->update($data);

        if ($request->role_id) {
            $user->syncRoles($request->role_id);
        }

        return response()->json([
            'data' => $user,
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
}
