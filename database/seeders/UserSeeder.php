<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Mengisi data pengguna untuk aplikasi Glamping Hayya.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@hayya.com',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Naufal Aly',
                'email' => 'naufal@hayya.com',
                'password' => Hash::make('naufal123'),
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}