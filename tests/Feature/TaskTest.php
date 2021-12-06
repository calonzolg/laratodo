<?php

namespace Tests\Feature;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_get_all_tasks()
    {
        Task::factory(10)->create();

        $response = $this->json('GET', '/api/tasks');

        $response->assertStatus(200)
            ->assertSee(['id' => rand(1, 10)]);
    }

    public function test_store_task()
    {
        $data = [
            'title' => $this->faker->word,
            'description' => $this->faker->paragraph,
        ];

        $response = $this->postJson('/api/tasks', $data);

        $response->assertSee($data['title'])->assertCreated();
    }

    public function test_update_task()
    {
        $task = Task::factory(1)->create()->first();

        $data = [
            'title' => $this->faker->word,
            'description' => $task->description,
        ];

        $response = $this->putJson('/api/tasks/'.$task->id, $data);

        $response->assertSee($data['title'])->assertOk();
    }

    public function test_complete_task()
    {
        $task = Task::factory(1)->create()->first();

        $response = $this->patchJson('/api/tasks/'.$task->id);
        $taskUpdated = $response->json()['task'];

        $response
            ->assertJsonFragment(
                [
                    'completed_at' => $taskUpdated['completed_at'],
                ]
            )
            ->assertOk();
    }

    public function test_destroy_task()
    {
        $task = Task::factory(1)->create()->first();

        $response = $this->deleteJson('/api/tasks/'.$task->id);

        $response
            ->assertJsonFragment(['taskId' => $task->id])
            ->assertOk();
    }
}
