<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Category::factory()->create();
        Category::factory()->create();
        Category::factory()->create();

      /*   Task::factory(5)->create(); */
    }
}
