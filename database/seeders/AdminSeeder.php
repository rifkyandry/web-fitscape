<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'adminfitscape@gmail.com'],
            [
                'name'      => 'Admin Fitscape',
                'password'  => Hash::make('adminfitscape123'),
                'role'      => 'admin',
                'member_id' => 'ADMIN-001',
                'totp_secret' => null,
            ]
        );
    }
}