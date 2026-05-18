<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\CreateProfileTrait;
use App\Models\Profile;

class UserController extends Controller
{
    use CreateProfileTrait;
    public function Register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'email' => 'email|required|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return response()->json(['message' => 'User Registered Successfully', 'user' => $user], 201);
    }


    public function Log_in(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);
        if (!Auth::attempt($request->only(['email', 'password'])))
            return response()->json(['message' => 'invalid email or password'], 403);
        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        $this->restore_profile($user);
        return response()->json([
            'message' => 'User logined Successfully',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function Log_out(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'User Logouted Successfully'], 200);
    }
}
