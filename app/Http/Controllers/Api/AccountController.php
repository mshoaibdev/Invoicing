<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\PersonalProfileUpdateRequest;
use App\Http\Resources\AccountResource;
use App\Traits\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class AccountController extends Controller
{
    use Upload;

    public function account(Request $request)
    {
        $user = Auth::user();

        return new AccountResource($user);
    }

    // update account password
    public function updateAccountPassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['string', 'confirmed', Password::defaults()],
        ]);

        // password hasing is in the user model
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'message' => 'Password successfully updated',
        ]);
    }

    public function updatePersonalProfile(PersonalProfileUpdateRequest $request)
    {

        $user = Auth::user();
        $path = 'avatars/'.$user->id;

        $data = $request->validated();

        if ($request->hasFile('avatar')) {

            if (Storage::exists($path.'/'.$user->avatar)) {
                Storage::delete($path.'/'.$user->avatar);
            }

            $fileName = $this->uploadAvatarAndResize($request->avatar, $path);
            $data['avatar'] = $fileName;
        }

        $user->update($data);

        return response()->json([
            'data' => $user,
            'message' => 'Personal Profile successfully updated',
        ]);
    }
}
