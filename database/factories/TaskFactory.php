<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = ['todo', 'in_progress', 'done'];

        return [
            'title' => fake()->sentence(4),
            'status' => fake()->randomElement($statuses),
            'due_date' => Carbon::now()->addDays(rand(1, 30)),
        ];
    }
}
