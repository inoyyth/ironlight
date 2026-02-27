<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@ironlight.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Create additional admin users for testing
        Admin::create([
            'name' => 'John Doe',
            'email' => 'john@ironlight.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        Admin::create([
            'name' => 'Jane Smith',
            'email' => 'jane@ironlight.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
    }
}
