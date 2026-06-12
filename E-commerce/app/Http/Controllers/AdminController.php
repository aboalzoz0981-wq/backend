<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\User;

class AdminController extends Controller
{
    public function Accept($userID)
    {
        $user = User::findOrFail($userID);
        $user->verify = true;
        $user->save();
        if ($user->role == 'admin') {
            Admin::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
            ]);
        }
        return response()->json('User Added Successfully', 201);
    }

    public function Reject($userID)
    {
        $user = User::findOrFail($userID);
        $user->delete();
        return response()->json('User Rejected Successfully', 200);
    }

    public function showCustomers()
    {
        $customers = User::where('role', 'customer')->where('verify', true)->get();
        return response()->json($customers, 200);
    }
    public function showCompanies()
    {
        $companies = User::where('role', 'company')->where('verify', true)->get();
        return response()->json($companies, 200);
    }
    public function showAdmins()
    {
        $admins = Admin::all();
        return response()->json($admins, 200);
    }
    public function acceptingCustomerRequests()
    {
        $requests = User::where('role', 'customer')->where('verify', false)->get();
        return response()->json($requests, 200);
    }
    public function acceptingCompanyRequests()
    {
        $requests = User::where('role', 'company')->where('verify', false)->get();
        return response()->json($requests, 200);
    }
    public function acceptingAdminRequests()
    {
        $requests = User::where('role', 'admin')->where('verify', false)->get();
        return response()->json($requests, 200);
    }
}
