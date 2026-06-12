<?php

namespace App;

use App\Models\Profile;
use App\Models\User;
use App\Notifications\UserNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

trait CreateProfileTrait
{

    public   function create_profile(User $request)
    {
        Profile::create([
            'user_id' => $request->id,
            'name' => $request->name
        ]);

        // Notification::send($request->email, new UserNotification($request));
    }
    public function restore_profile(User $request)
    {
        try {
            $profile = Profile::onlyTrashed()->where('user_id', $request->id)->firstOrFail();
            $profile->restore();
            return response()->json('The profile has been restore', 200);
        } catch (Exception $e) {
            Profile::create([
                'user_id' => $request->id,
                'name' => $request->name
            ]);
            return response()->json('The profile has been add', 201);
        }
    }
}
