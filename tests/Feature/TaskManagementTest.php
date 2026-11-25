<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskManagementTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_home_page_displays_task_management_screen(): void
    {
        $this->get('/')
            ->assertRedirect('/dashboard');

        $this->get('/dashboard')
            ->assertOk()
            ->assertSee('Dashboard')
            ->assertSee('Tenggat berikutnya')
            ->assertSee('Aktivitas minggu ini')
            ->assertSee('Study streak')
            ->assertSee('Tugas Baru');

        $this->get('/tasks')
            ->assertOk()
            ->assertSee('Daftar tugas')
            ->assertDontSee('Tugas baru');

        $this->get('/tasks/create')
            ->assertOk()
            ->assertSee('Informasi tugas');
    }

    public function test_user_can_create_edit_filter_and_delete_a_task(): void
    {
        $this->post('/tasks', [
            'title' => 'Tulis dokumentasi',
            'course' => 'Basis Data',
            'assignment_type' => 'project',
            'description' => 'Panduan singkat untuk tim',
            'status' => 'pending',
            'priority' => 'high',
            'due_date' => '2026-12-01',
        ])->assertRedirect('/tasks');

        $task = Task::firstOrFail();
        $this->assertSame('Tulis dokumentasi', $task->title);

        $this->get('/tasks?status=pending&course=Basis%20Data&search=dokumentasi')
            ->assertOk()
            ->assertSee('Basis Data')
            ->assertSee('Tulis dokumentasi');

        $this->put("/tasks/{$task->id}", [
            'title' => 'Dokumentasi selesai',
            'course' => 'Basis Data',
            'assignment_type' => 'project',
            'status' => 'completed',
            'priority' => 'medium',
            'due_date' => null,
        ])->assertRedirect('/tasks');

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Dokumentasi selesai',
            'course' => 'Basis Data',
            'status' => 'completed',
        ]);

        $this->delete("/tasks/{$task->id}")
            ->assertRedirect('/tasks');

        $this->assertSoftDeleted('tasks', ['id' => $task->id]);

        $this->get('/tasks/trash')
            ->assertOk()
            ->assertSee('Dokumentasi selesai');

        $this->post("/tasks/{$task->id}/restore")
            ->assertRedirect('/tasks/trash');

        $this->assertNotSoftDeleted('tasks', ['id' => $task->id]);

        $this->delete("/tasks/{$task->id}")
            ->assertRedirect('/tasks');

        $this->delete("/tasks/{$task->id}/force-delete")
            ->assertRedirect('/tasks/trash');

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_task_input_is_validated(): void
    {
        $this->from('/tasks')->post('/tasks', [
            'title' => '',
            'course' => '',
            'assignment_type' => 'bad',
            'status' => 'unknown',
            'priority' => 'urgent',
        ])->assertRedirect('/tasks')
            ->assertSessionHasErrors(['title', 'course', 'assignment_type', 'status', 'priority']);

        $this->assertDatabaseCount('tasks', 0);
    }

    public function test_task_data_is_private_to_its_owner(): void
    {
        $task = $this->user->tasks()->create([
            'title' => 'Tugas privat',
            'course' => 'Pemrograman',
            'assignment_type' => 'assignment',
            'status' => 'pending',
            'priority' => 'medium',
        ]);
        $otherUser = User::factory()->create();

        $this->actingAs($otherUser)
            ->get('/tasks')
            ->assertOk()
            ->assertDontSee('Tugas privat');

        $this->get("/tasks/{$task->id}/edit")->assertNotFound();
    }

    public function test_study_streak_is_available_on_other_student_pages(): void
    {
        \App\Models\Task::create([
            'user_id' => $this->user->id,
            'title' => 'Tugas hari ini',
            'course' => 'Kalkulus',
            'assignment_type' => 'assignment',
            'status' => 'pending',
            'priority' => 'medium',
            'due_date' => now()->addDay(),
        ]);

        $this->get('/tasks')
            ->assertOk()
            ->assertSee('Study streak')
            ->assertSee('1 hari')
            ->assertSee('Tugas hari ini');
    }
}
