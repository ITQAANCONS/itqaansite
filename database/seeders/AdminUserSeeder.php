<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'alsaeed41@gmail.com');

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => env('ADMIN_NAME', 'ITQAAN Admin'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'Itqaan@2026')),
                'email_verified_at' => now(),
            ],
        );
    }
}
