<?php

namespace App\Http\Controllers\Api;

use App\Traits\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\AccountResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\Api\UserController;
use App\Http\Requests\Account\UpdateProfile;
use App\Http\Requests\Account\PersonalProfileUpdateRequest;

class AccountController extends Controller
{
    use Upload;

    public function account(Request $request)
    {
        $user = Auth::user()->load('address');

        return new AccountResource($user);
    }

    // update account password
    public function updateAccountPassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['string', 'confirmed', Password::defaults()],
        ]);

        $user = Auth::user();
        $user->password = $request->password;
        $user->save();

        return response()->json([
            'message' => 'Password successfully updated',
        ]);
    }

    public function updatePersonalProfile(UpdateProfile $request)
    {

        $user = Auth::user();
        if ($request->hasFile('avatar')) {
            (new UserController)->uploadAvatar($request, $user);
        }

        $user->update($request->getUserPayload());

        if ($request->address) {
            $user->address()->updateOrCreate(
                ['type' => 'home'],
                $request->getAddressPayload()
            );
    }

        return response()->json([
            'data' => $user,
            'message' => 'Personal Profile successfully updated',
        ]);
    }
}
