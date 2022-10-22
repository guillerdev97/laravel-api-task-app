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

        $status = $data['status'];
        $array = $data['msg'];
        $this->assertEquals(0, $status);
        $this->assertEquals('There are not tasks', $array);
    }

    public function test_user_can_create_task_if_validations_passed()
    {
        $this->withExceptionHandling();

        // given 
        Category::factory(3)->create();
        Task::factory()->create();

        // when 
        $response = $this->postJson(route('createTask', array(
            'name' => 'New task name',
            'category_id' => 1,
            'description' => 'New task description'
        )));

        // then
        $response->assertStatus(200);

        $this->assertCount(2, Task::all());
        
        $jsonData = $response->decodeResponseJson();
        $statusCode = $jsonData['status'];
        $newTaskCategory = $jsonData['data']['category_id'];
        $this->assertEquals(1, $statusCode);
        $this->assertEquals(1, $newTaskCategory);
    }

    public function test_user_can_not_create_task_if_validations_not_passed()
    {
        $this->withExceptionHandling();

        // given 
        Category::factory(3)->create();
        Task::factory()->create();

        // when 
        $response = $this->postJson(route('createTask', array(
            'name' => '',
            'category_id' => 1,
            'description' => 'New task description'
        )));

        // then
        $response->assertStatus(400);

        $this->assertCount(1, Task::all());
        
        $jsonData = $response->decodeResponseJson();
        $statusCode = $jsonData['status'];
        $this->assertEquals(0, $statusCode);
    }
 
}
