<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean',
        ]);

        $credentials = request(['email', 'password']);

        if (! Auth::attempt($credentials)) {

            return response()->json([
                'message' => 'The provided credentials are incorrect.',
            ], 401);
        }

        $user = $request->user();

        if (! $user->status) {
            return response()->json([
                'message' => 'Your account is deactive, please contact site administrator.',
            ], 401);
        }

        $token = $user->createToken('PortalToken')->plainTextToken;

        $role = $user->roles[0]->name;

        $userData = $user->only(['name', 'avatar', 'id', 'avatar_url']);

        $userAbilities = $user->roles[0]->permissions->map(function ($permission) {
            return $permission->name;
        })->toArray();

        // create new array of permission which includes action and subject as permission name
        $userAbilities = array_map(function ($permission) {
            $itemArr = explode('-', $permission);

            $lastIndex = count($itemArr) - 1;
            $action = $itemArr[$lastIndex];

            if ($action == 'list') {
                $actionName = 'Read';
            } elseif ($action == 'edit') {
                $actionName = 'Update';
            } elseif ($action == 'create') {
                $actionName = 'Create';
            } elseif ($action == 'delete') {
                $actionName = 'Delete';
            } else {
                $actionName = 'Read';
            }

            return [
                'action' => $actionName,
                'subject' => $permission,
            ];
        }, $userAbilities);

        return response()->json([
            'token' => $token,
            'userData' => array_merge($userData, ['role' => $role]),
            'userAbilities' => $userAbilities,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->noContent();
    }
}
