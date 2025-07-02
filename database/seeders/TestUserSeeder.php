<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'ZEE',
            'email' => 'admin@usjr.edu.ph',
            'password' => bcrypt('admin123'),
        ]);
    }
}
