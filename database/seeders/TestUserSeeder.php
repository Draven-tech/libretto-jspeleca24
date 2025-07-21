<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;  // This is the correct import path
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'admin@usjr.edu.ph'],
            [
                'name' => 'ZEE',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );
    }
}