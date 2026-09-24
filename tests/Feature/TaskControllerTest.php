<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_task_can_be_created(): void
    {
        $response = $this->post('/tasks', [
            'task_name' => 'Write tests',
            'description' => 'Cover the task workflow',
            'status' => 'Pending',
            'due_date' => '2026-09-30',
        ]);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', [
            'task_name' => 'Write tests',
            'status' => 'Pending',
        ]);
    }

    public function test_a_task_can_be_updated_and_returns_to_the_homepage(): void
    {
        $task = Task::create([
            'task_name' => 'Old task',
            'description' => null,
            'status' => 'Pending',
            'due_date' => null,
        ]);

        $response = $this->put("/tasks/{$task->id}", [
            'task_name' => 'Updated task',
            'description' => 'Updated description',
            'status' => 'Completed',
            'due_date' => '2026-10-01',
        ]);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'task_name' => 'Updated task',
            'status' => 'Completed',
        ]);
    }

    public function test_a_task_can_be_deleted(): void
    {
        $task = Task::create([
            'task_name' => 'Remove task',
            'description' => null,
            'status' => 'Pending',
            'due_date' => null,
        ]);

        $response = $this->delete("/tasks/{$task->id}");

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
