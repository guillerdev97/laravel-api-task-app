<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // users
        User::factory()->create([
          'email' => 'guiller@gmail.com'
        ]);

        // categories
        Category::factory()->create();
        Category::factory()->create();
        Category::factory()->create();

        // tasks

        Task::factory(5)->create();
    }
}
