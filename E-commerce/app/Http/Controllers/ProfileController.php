<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;
use App\Http\Resources\UserResource;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function display_profile()
    {
        $user_id = Auth::user()->id;
        $profile = Profile::with('user')->where('user_id', $user_id)->firstOrFail();
        return  new ProfileResource($profile);
    }


    public function update_profile(Request $request)
    {
        
        $profile = Auth::user()->profile;
        $request->validate([
            'name' => 'string|max:255|sometimes',
            'phone' => 'string|between:0,10|sometimes|size:10',
        ]);
        $profile->update($request->only(['name', 'phone']));
        return response()->json($profile, 200);
    }

    public function update_profile_image(Request $request)
    {
        $profile = Auth::user()->profile;
        $request->validate([
            'image' => 'required|image|mimes:png,jpg'
        ]);
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($request->image);
            $path = $request->file('image')->store('Photo', 'public');
            $profile['image'] = $path;
            $profile->save();
        }
        return response()->json($profile, 200);
    }

    public function distroy()
    {
        $profile_id = Auth::user()->profile->id;
        $profile = Profile::findOrFail($profile_id);
        $profile->delete();
        return response()->json(['message' => 'the profile deleted successfully'], 200);
    }

    public function attach_Catigory($catigory_id)
    {
        $profile = Auth::user()->profile;
        $profile->catigories()->attach($catigory_id);
        return response()->json(['message' => 'Catigory Attached Successfully'], 201);
    }
}
