<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_can_see_all_tasks()
    {
        //  given
        Category::factory(3)->create();
        Task::factory(5)->create();

        // when
        $response = $this->get(route('listTasks'));

        // then
        $response->assertStatus(200);
        $data = $response->decodeResponseJson();
        $array = $data['data'];
        $this->assertCount(5, $array);
    }
}
