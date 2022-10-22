<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_can_see_all_tasks_if_length_more_than_zero()
    {
        //  given
        Category::factory(3)->create();
        Task::factory(5)->create();

        // when
        $response = $this->getJson(route('listTasks'));

        // then
        $response->assertStatus(200);

        $data = $response->decodeResponseJson();

        $array = $data['data'];
        $this->assertCount(5, $array);
    }

    public function test_user_can_see_error_tasks_if_length_equals_to_zero()
    {
        //  given
        Category::factory(3)->create();

        // when
        $response = $this->getJson(route('listTasks'));

        // then
        $response->assertStatus(404);

        $data = $response->decodeResponseJson();

        $array = $data['msg'];
        $this->assertEquals('There are not tasks', $array);
    }
}
