<?php

namespace App\Modules\Tasks\Database\Seeders;

use App\Modules\Auth\Models\User;
use App\Modules\Tasks\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            Task::factory(3)->create([
                'user_id' => $user->id,
                'completed' => false,
                'completed_at' => null,
            ]);

            Task::factory(2)->create([
                'user_id' => $user->id,
                'completed' => true,
                'completed_at' => \Carbon\Carbon::now('America/Sao_Paulo'),
            ]);
        }

    }
} 