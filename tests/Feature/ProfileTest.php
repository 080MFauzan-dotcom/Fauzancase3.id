<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_can_update_profile_information(): void
    {
        $user = User::factory()->create([
            'name' => 'Nama Lama',
            'email' => 'lama@example.test',
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user)->put('/profile', [
            'name' => 'Nama Baru',
            'email' => 'baru@example.test',
            'nim' => '12345678',
            'faculty' => 'Fakultas Teknik',
            'major' => 'Teknik Elektro',
            'interests' => 'Elektronika dan robotika',
        ])->assertRedirect('/profile')
            ->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Nama Baru',
            'email' => 'baru@example.test',
            'email_verified_at' => null,
            'nim' => '12345678',
            'faculty' => 'Fakultas Teknik',
            'major' => 'Teknik Elektro',
            'interests' => 'Elektronika dan robotika',
        ]);
    }

    public function test_student_cannot_use_another_students_nim(): void
    {
        $user = User::factory()->create();
        User::factory()->create(['nim' => '12345678']);

        $this->actingAs($user)->from('/profile')->put('/profile', [
            'name' => $user->name,
            'email' => $user->email,
            'nim' => '12345678',
            'faculty' => 'Fakultas Teknik',
            'major' => 'Teknik Elektro',
            'interests' => 'Robotika',
        ])->assertRedirect('/profile')
            ->assertSessionHasErrors('nim');

        $this->assertNull($user->fresh()->nim);
    }

    public function test_student_cannot_use_another_students_email(): void
    {
        $user = User::factory()->create();
        User::factory()->create(['email' => 'used@example.test']);

        $this->actingAs($user)->from('/profile')->put('/profile', [
            'name' => 'Nama Baru',
            'email' => 'used@example.test',
        ])->assertRedirect('/profile')
            ->assertSessionHasErrors('email');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => $user->email,
        ]);
    }

    public function test_student_can_change_password_with_the_current_password(): void
    {
        $user = User::factory()->create(['password' => Hash::make('kata-lama-123')]);

        $this->actingAs($user)->put('/profile/password', [
            'current_password' => 'kata-lama-123',
            'password' => 'kata-baru-123',
            'password_confirmation' => 'kata-baru-123',
        ])->assertRedirect('/profile')
            ->assertSessionHas('password_success')
            ->assertAuthenticatedAs($user);

        $this->assertTrue(Hash::check('kata-baru-123', $user->fresh()->password));
    }

    public function test_student_must_provide_the_correct_current_password(): void
    {
        $user = User::factory()->create(['password' => Hash::make('kata-lama-123')]);

        $this->actingAs($user)->from('/profile')->put('/profile/password', [
            'current_password' => 'salah',
            'password' => 'kata-baru-123',
            'password_confirmation' => 'kata-baru-123',
        ])->assertRedirect('/profile')
            ->assertSessionHasErrors('current_password');

        $this->assertTrue(Hash::check('kata-lama-123', $user->fresh()->password));
    }
}
