<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'user')->get();

        foreach ($users as $user) {
            // Each user gets 2–3 projects
            Project::factory()->count(rand(2, 3))->create([
                'user_id' => $user->id,
            ]);
        }

        // Optionally, let admin also own some projects
        $admin = User::where('role', 'admin')->first();
        Project::factory()->count(3)->create([
            'user_id' => $admin->id,
        ]);
    }
}
