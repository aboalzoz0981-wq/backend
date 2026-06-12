<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'AboAlzoz',
            'email' => "Abd@gmail.com",
            'password' => Hash::make("IT123456"),
            'role' => 'admin',
            'verify' => true
        ]);

        Admin::create([
            'user_id' => $user->id,
            'name' => "Abdallh",
            'email' => $user->email,
            'password' => $user->password
        ]);
    }
}
