<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Super Admin
        $superAdminUser = User::create([
            'nric' => '900101125555',
            'name' => 'Super Admin JTMK',
            'phone_number' => '0123456789',
            'email' => 'superadmin@jtmk.com',
            'email_verified_at' => now(),
            'first_login_at' => now(),
            'password' => Hash::make('password'),
        ]);
        $superAdminUser->assignRole('Super Admin');

        // 2. Admin
        $adminUser = User::create([
            'nric' => '950202126666',
            'name' => 'Admin Staff',
            'phone_number' => '0198765432',
            'email' => 'admin@jtmk.com',
            'email_verified_at' => now(),
            'first_login_at' => now(),
            'password' => Hash::make('password'),
        ]);
        $adminUser->assignRole('Admin');
    }
}
