<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_can_register_with_a_hashed_password(): void
    {
        $this->post('/register', [
            'name' => 'Mahasiswa Test',
            'email' => 'mahasiswa@example.test',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123',
        ])->assertRedirect('/dashboard');

        $user = User::where('email', 'mahasiswa@example.test')->firstOrFail();

        $this->assertNotSame('rahasia123', $user->password);
        $this->assertTrue(Hash::check('rahasia123', $user->password));
        $this->assertAuthenticatedAs($user);
    }

    public function test_student_can_log_in_and_log_out(): void
    {
        $user = User::factory()->create([
            'email' => 'student@example.test',
            'password' => Hash::make('rahasia123'),
        ]);

        $this->post('/login', [
            'email' => 'student@example.test',
            'password' => 'rahasia123',
        ])->assertRedirect('/dashboard')
            ->assertAuthenticatedAs($user);

        $this->post('/logout')
            ->assertRedirect('/login')
            ->assertGuest();
    }

    public function test_invalid_credentials_are_rejected(): void
    {
        User::factory()->create([
            'email' => 'student@example.test',
            'password' => Hash::make('rahasia123'),
        ]);

        $this->from('/login')->post('/login', [
            'email' => 'student@example.test',
            'password' => 'wrong-password',
        ])->assertRedirect('/login')
            ->assertSessionHasErrors('email')
            ->assertGuest();
    }
}
