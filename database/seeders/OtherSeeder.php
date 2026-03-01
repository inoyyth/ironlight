<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Other;

class OtherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Other::create([
            'how_works' => 'How works description',
            'this_for' => 'This for description',
            'this_not_for' => 'This not for description',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $this->command->info('Other seeder completed successfully!');
    }
}
