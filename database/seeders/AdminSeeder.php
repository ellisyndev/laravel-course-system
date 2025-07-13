<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => '系統管理員',
                'password' => Hash::make('Password!123'), // 預設密碼
                'email_verified_at' => now(),
            ]
        );
    }
}
