<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@roadcare.com'],
            [
                'name' => 'Admin RoadCare',
                'email' => 'admin@roadcare.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Petugas Lapangan
        User::updateOrCreate(
            ['email' => 'petugas@roadcare.com'],
            [
                'name' => 'Petugas Lapangan',
                'email' => 'petugas@roadcare.com',
                'password' => Hash::make('petugas123'),
                'role' => 'petugas',
            ]
        );

        // User Biasa
        User::updateOrCreate(
            ['email' => 'user@roadcare.com'],
            [
                'name' => 'User RoadCare',
                'email' => 'user@roadcare.com',
                'password' => Hash::make('user123'),
                'role' => 'user',
            ]
        );
    }
}
