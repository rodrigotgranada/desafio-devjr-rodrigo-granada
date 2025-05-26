<?php

namespace App\Modules\Auth\Tests\Feature;

use App\Modules\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/dashboard');
    }

    public function test_user_can_register_with_valid_data(): void
    {
        $response = $this->post('/register', [
            'name' => 'Novo Usuário',
            'email' => 'novo@teste.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('users', [
            'name' => 'Novo Usuário',
            'email' => 'novo@teste.com'
        ]);
    }

    public function test_registration_fails_with_existing_email(): void
    {
        $this->post('/register', [
            'name' => 'Usuário',
            'email' => 'teste@teste.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        
        $this->post('/logout');
        $this->assertGuest();

        $response = $this->post('/register', [
            'name' => 'Outro',
            'email' => 'teste@teste.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_registration_fails_with_short_password(): void
    {
        $response = $this->post('/register', [
            'name' => 'Usuário',
            'email' => 'teste2@teste.com',
            'password' => '123',
            'password_confirmation' => '123',
        ]);

        $response->assertSessionHasErrors('password');
    }

    public function test_registration_fails_with_mismatched_passwords(): void
    {
        $response = $this->post('/register', [
            'name' => 'Usuário',
            'email' => 'teste3@teste.com',
            'password' => 'password123',
            'password_confirmation' => 'password456',
        ]);

        $response->assertSessionHasErrors('password');
    }
}
