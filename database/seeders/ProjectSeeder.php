<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            ['name' => 'Personal Tasks'],
            ['name' => 'Work Projects'],
            ['name' => 'Home Improvement'],
            ['name' => 'Learning Goals'],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
