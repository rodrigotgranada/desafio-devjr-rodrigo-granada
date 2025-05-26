<?php

namespace App\Modules\Tasks\Tests\Feature;

use App\Modules\Auth\Models\User;
use App\Modules\Tasks\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_task()
    {
        $user = $this->loginAsUser();
        $response = $this->post('/tasks', [
            'title' => 'Minha tarefa',
            'description' => 'Descrição da tarefa',
            'due_date' => now()->addDay()->format('Y-m-d\TH:i'),
        ]);
        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('tasks', [
            'title' => 'Minha tarefa',
            'user_id' => $user->id,
        ]);
    }

    public function test_guest_cannot_create_task()
    {
        $response = $this->post('/tasks', [
            'title' => 'Tarefa',
            'description' => 'Descrição',
            'due_date' => now()->addDay()->format('Y-m-d\TH:i'),
        ]);
        $response->assertRedirect('/login');
    }

    public function test_user_can_edit_own_task()
    {
        $user = $this->loginAsUser();
        $task = Task::factory()->create(['user_id' => $user->id]);
        $response = $this->put("/tasks/{$task->id}", [
            'title' => $task->title,
            'description' => 'Nova descrição',
            'due_date' => now()->addDays(2)->format('Y-m-d\TH:i'),
            'completed' => true,
        ]);
        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'description' => 'Nova descrição',
            'completed' => true,
        ]);
        $this->assertNotNull(Task::find($task->id)->completed_at);
    }

    public function test_user_cannot_edit_others_task()
    {
        $user = $this->loginAsUser();
        $other = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $other->id]);
        $response = $this->actingAs($user)->put("/tasks/{$task->id}", [
            'title' => $task->title,
            'description' => 'Tentativa de edição',
            'due_date' => now()->addDays(2)->format('Y-m-d\TH:i'),
            'completed' => true,
        ]);
        $response->assertForbidden();
    }

    public function test_user_can_delete_own_task()
    {
        $user = $this->loginAsUser();
        $task = Task::factory()->create(['user_id' => $user->id]);
        $response = $this->delete("/tasks/{$task->id}");
        $response->assertRedirect('/dashboard');
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_user_cannot_delete_others_task()
    {
        $user = $this->loginAsUser();
        $other = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $other->id]);
        $response = $this->actingAs($user)->delete("/tasks/{$task->id}");
        $response->assertForbidden();
    }

    public function test_user_can_view_only_own_tasks()
    {
        $user = $this->loginAsUser();
        $other = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);
        $otherTask = Task::factory()->create(['user_id' => $other->id]);
        $response = $this->get('/dashboard');
        $response->assertSee($task->title);
        $response->assertDontSee($otherTask->title);
    }

    public function test_user_can_toggle_task_status()
    {
        $user = $this->loginAsUser();
        $task = Task::factory()->create(['user_id' => $user->id, 'completed' => false, 'completed_at' => null]);
        $response = $this->patch("/tasks/{$task->id}/toggle");
        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'completed' => true]);
        $this->assertNotNull(Task::find($task->id)->completed_at);
    }

    public function test_task_filter_and_sort()
    {
        $user = $this->loginAsUser();
        Task::factory()->create(['user_id' => $user->id, 'title' => 'A tarefa']);
        Task::factory()->create(['user_id' => $user->id, 'title' => 'B tarefa']);
        $response = $this->get('/dashboard?sort=title&order=asc');
        $response->assertSeeInOrder(['A tarefa', 'B tarefa']);
    }
}