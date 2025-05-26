<?php

namespace App\Modules\Tasks\Database\Factories;

use App\Modules\Auth\Models\User;
use App\Modules\Tasks\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{

    protected $model = Task::class;

    public function definition(): array
    {
        $completed = $this->faker->boolean(30);
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'completed' => $completed,
            'completed_at' => $completed ? \Carbon\Carbon::now('America/Sao_Paulo') : null,
            'user_id' => User::factory(),
        ];
    }
} 