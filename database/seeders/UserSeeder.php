<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Membuat Akun Admin
        User::create([
            'name'     => 'Admin SmartLaundry',
            'email'    => 'admin@laundry.com',
            'password' => Hash::make('password123'), // Passwordnya: password123
            'role'     => 'admin',
        ]);

        // 2. Membuat Akun Pelanggan (User Biasa)
        User::create([
            'name'     => 'Budi Pelanggan',
            'email'    => 'budi@gmail.com',
            'password' => Hash::make('password123'), // Passwordnya: password123
            'role'     => 'user',
        ]);
    }
}
