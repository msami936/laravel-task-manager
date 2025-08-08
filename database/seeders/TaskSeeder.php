<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Project;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();

        foreach ($projects as $project) {
            $tasks = [
                ['name' => 'Complete project planning', 'priority' => 1],
                ['name' => 'Review requirements', 'priority' => 2],
                ['name' => 'Create initial design', 'priority' => 3],
                ['name' => 'Implement core features', 'priority' => 4],
                ['name' => 'Test functionality', 'priority' => 5],
            ];

            foreach ($tasks as $task) {
                Task::create([
                    'name' => $task['name'],
                    'priority' => $task['priority'],
                    'project_id' => $project->id,
                ]);
            }
        }
    }
}
