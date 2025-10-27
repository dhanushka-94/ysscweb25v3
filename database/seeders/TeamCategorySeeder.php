<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TeamCategory;

class TeamCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Main Team',
                'description' => 'Senior team members and first team players',
                'color' => '#facc15',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Under 16 Team',
                'description' => 'Youth team players under 16 years old',
                'color' => '#3b82f6',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Under 18 Team',
                'description' => 'Youth team players under 18 years old',
                'color' => '#10b981',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Coaching Staff',
                'description' => 'Coaches, assistant coaches, and technical staff',
                'color' => '#8b5cf6',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Management',
                'description' => 'Team management and administrative staff',
                'color' => '#f59e0b',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Reserve Team',
                'description' => 'Reserve team players and substitutes',
                'color' => '#ef4444',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            TeamCategory::create($category);
        }
    }
}
