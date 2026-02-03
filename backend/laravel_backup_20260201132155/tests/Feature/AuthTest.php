<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_success()
    {
        $payload = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ];

        $this->postJson('/api/register', $payload)
            ->assertStatus(201)
            ->assertJsonStructure(['user' => ['id','email','name','role']]);
    }

    public function test_register_validation_error()
    {
        $payload = [
            'name' => '',
            'email' => 'invalid',
            'password' => '123',
        ];

        $this->postJson('/api/register', $payload)
            ->assertStatus(422);
    }

    public function test_login_success_and_logout()
    {
        $user = User::factory()->create(['password' => bcrypt('secret123')]);

        // API login requesting token (device_name)
        $resp = $this->postJson('/api/login', ['email' => $user->email, 'password' => 'secret123', 'device_name' => 'test-device'])
            ->assertStatus(200)
            ->assertJsonStructure(['user','token']);

        $token = $resp->json('token');

        // Use token to call protected logout endpoint
        $this->withHeader('Authorization', 'Bearer '.$token)
            ->postJson('/api/logout')
            ->assertStatus(200);
    }

    public function test_password_reset_flow()
    {
        $user = User::factory()->create(['email' => 'reset@example.com']);

        $this->postJson('/api/password/forgot', ['email' => $user->email])
            ->assertStatus(200);
    }
}
