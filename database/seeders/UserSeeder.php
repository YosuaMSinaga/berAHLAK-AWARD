<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $nip = env('ADMIN_NIP');
        $nama = env('ADMIN_NAMA');
        $username = env('ADMIN_USERNAME');
        $password = env('ADMIN_PASSWORD');

        if (!$nip || !$nama || !$username || !$password) {
            return;
        }

        User::updateOrCreate(
            [
                'nip' => $nip,
            ],
            [
                'nama' => $nama,
                'username' => $username,
                'password' => Hash::make($password),
                'role' => 'admin',
            ]
        );
    }
}