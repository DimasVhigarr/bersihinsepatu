<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'), // password: admin123
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'is_admin' => 1, // ✅ ganti jadi angka, bukan string
        ]);

        // User biasa
        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('user1234'), // password: user123
            'role' => 'user',
            'is_admin' => 0, // ✅
        ]);
    }
}

// // User biasa
        // User::create([
        //     'name' => 'User',
        //     'email' => 'user@example.com',
        //     'password' => Hash::make('user123'), // password: user123
        //     'role' => 'user',
        // ]);