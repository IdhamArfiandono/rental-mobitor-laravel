<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create(['name' => 'Admin Mobitor', 'email' => 'admin@rentalmobitor.com', 'password' => Hash::make('admin123'), 'role' => 'admin', 'phone' => '081200000001']);
        User::create(['name' => 'Staff Mobitor', 'email' => 'staff@rentalmobitor.com', 'password' => Hash::make('staff123'), 'role' => 'staff', 'phone' => '081200000002']);
        User::create(['name' => 'Budi Santoso', 'email' => 'budi@example.com', 'password' => Hash::make('password'), 'role' => 'pelanggan', 'phone' => '081211111111']);
        User::create(['name' => 'Siti Rahayu', 'email' => 'siti@example.com', 'password' => Hash::make('password'), 'role' => 'pelanggan', 'phone' => '081222222222']);
        User::create(['name' => 'Agus Wijaya', 'email' => 'agus@example.com', 'password' => Hash::make('password'), 'role' => 'pelanggan', 'phone' => '081233333333']);
        User::create(['name' => 'Dewi Lestari', 'email' => 'dewi@example.com', 'password' => Hash::make('password'), 'role' => 'pelanggan', 'phone' => '081244444444']);
        User::create(['name' => 'Rizky Pratama', 'email' => 'rizky@example.com', 'password' => Hash::make('password'), 'role' => 'pelanggan', 'phone' => '081255555555']);
    }
}
