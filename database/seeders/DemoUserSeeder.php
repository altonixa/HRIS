<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        $superAdmin = User::updateOrCreate(
            ['email' => 'admin@altonixa.com'],
            [
                'name' => 'Altonixa Admin',
                'password' => Hash::make('demo1234'),
                'email_verified_at' => now(),
            ]
        );
        $superAdmin->assignRole('Super Admin');

        // HR Manager
        $hrManager = User::updateOrCreate(
            ['email' => 'hr@altonixa.com'],
            [
                'name' => 'Demo HR Manager',
                'password' => Hash::make('hrdemo1234'),
                'email_verified_at' => now(),
            ]
        );
        $hrManager->assignRole('HR Manager');
    }
}
