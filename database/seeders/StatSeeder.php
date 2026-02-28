<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stat;

class StatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Create default admin user
        Stat::create([
            'name' => 'Projects',
            'value' => '100+',
            'description' => 'Global coverage',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        // Create additional admin users for testing
        Stat::create([
            'name' => 'Users',
            'value' => '50,000+',
            'description' => 'Trusted daily',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Stat::create([
            'name' => 'Rating',
            'value' => '4.9/5',
            'description' => 'Loved by customers',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
    }
}
