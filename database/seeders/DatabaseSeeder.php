<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            \App\Modules\Auth\Database\Seeders\UserSeeder::class,
            \App\Modules\Tasks\Database\Seeders\TaskSeeder::class,
        ]);
    }
} 