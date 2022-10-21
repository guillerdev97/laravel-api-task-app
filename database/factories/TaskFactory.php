<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class TaskFactory extends Factory
{
    public function definition()
    {
        $categoriesId = Category::all()->pluck('id');

        return [
            'name' => 'Task name',
            'category_id' => $this->faker->randomElement($categoriesId),
            'description' => 'Task description'
        ];
    }
}
