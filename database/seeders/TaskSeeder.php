<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();
        $userIds = User::pluck('id')->toArray();

        foreach ($projects as $project) {
            Task::factory()->count(rand(5, 10))->create([
                'project_id' => $project->id,
                'assigned_to' => $userIds ? fake()->randomElement($userIds) : null,
            ]);
        }
    }
}
