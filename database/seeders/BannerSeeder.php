<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample banner images directory if it doesn't exist
        $bannerPath = storage_path('app/public/banners');
        if (!is_dir($bannerPath)) {
            mkdir($bannerPath, 0755, true);
        }

        // Create a default banner
        $banner = Banner::updateOrCreate(
            ['id' => 1],
            [
                'title' => 'Senior technical delivery',
                'description' => 'Discover our powerful web application platform built with cutting-edge technology. Experience seamless development, robust features, and modern design.',
                'image' => null, // Will be set later via upload
                'created_by' => 1, // Admin user ID
                'updated_by' => 1, // Admin user ID
            ]
        );

        $this->command->info('Banner seeder completed successfully!');
    }
}
