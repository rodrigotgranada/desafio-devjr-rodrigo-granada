<?php

namespace App\Modules\Auth\Database\Seeders;

use App\Modules\Auth\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        User::factory(3)->create();
    }
} 