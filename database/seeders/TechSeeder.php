<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tech;

class TechSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lists = [
            [
                'other_id' => 1,
                'title' => 'React',
                'url' => 'https://reactjs.org',
            ],
            [
                'other_id' => 1,
                'title' => 'PHP/Laravel',
                'url' => 'https://laravel.com',
            ],
            [
                'other_id' => 1,
                'title' => 'Native apps',
                'url' => 'https://developer.apple.com/swift/',
            ],
            [
                'other_id' => 1,
                'title' => 'eCommerce',
                'url' => 'https://www.figma.com/',
            ],
            [
                'other_id' => 1,
                'title' => 'B2B integrations',
                'url' => 'https://www.figma.com/',
            ],
            [
                'other_id' => 1,
                'title' => 'Telcom',
                'url' => 'https://www.figma.com/',
            ],
        ];
        
        foreach ($lists as $list) {
            Tech::create([
                'other_id' => $list['other_id'],
                'title' => $list['title'],
                'url' => $list['url'],
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }
        $this->command->info('Tech seeder completed successfully!');
    }

}
