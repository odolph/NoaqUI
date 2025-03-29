<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a demo user
        $user = User::factory()->create([
            'name' => 'Demo User',
            'email' => 'demo@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create some projects
        $projects = [
            ['name' => 'Website Redesign', 'key' => 'WEB'],
            ['name' => 'Mobile App', 'key' => 'APP'],
            ['name' => 'API Development', 'key' => 'API'],
        ];

        foreach ($projects as $project) {
            Project::create([
                'name' => $project['name'],
                'key' => $project['key'],
                'description' => 'Sample project description for ' . $project['name'],
                'user_id' => $user->id,
            ]);
        }

        // Create some tasks for each project
        $statuses = ['todo', 'in_progress', 'done'];
        $priorities = ['low', 'medium', 'high'];

        Project::all()->each(function ($project) use ($user, $statuses, $priorities) {
            foreach (range(1, 5) as $i) {
                Task::create([
                    'title' => "Task $i for {$project->name}",
                    'description' => "This is a sample task description for task $i",
                    'status' => $statuses[array_rand($statuses)],
                    'priority' => $priorities[array_rand($priorities)],
                    'user_id' => $user->id,
                    'project_id' => $project->id,
                    'due_date' => now()->addDays(rand(1, 30)),
                ]);
            }
        });
    }
}
