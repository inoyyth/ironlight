<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Solution;

class SolutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $lists = [
            [
                'other_id' => 1,
                'title' => 'Workforce Time Tracking App',
                'description' => 'A comprehensive workforce time tracking application designed to streamline employee scheduling, attendance monitoring, and productivity analysis for modern businesses.',
            ],
            [
                'other_id' => 1,
                'title' => 'Worktime Analytics Dashboard',
                'description' => 'A robust backend framework built with PHP and Laravel, providing scalable and secure solutions for enterprise-level applications.',
            ],
            [
                'other_id' => 1,
                'title' => 'HR Operations Automation Platform',
                'description' => 'A comprehensive HR management system that automates payroll processing, benefits administration, and employee lifecycle management.',
            ],
        ];
        
        foreach ($lists as $list) {
            Solution::create([
                'other_id' => $list['other_id'],
                'title' => $list['title'],
                'description' => $list['description'],
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }
        $this->command->info('Solution seeder completed successfully!');
    }
}
