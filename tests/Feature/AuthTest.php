<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_register_a_user()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password'
        ];

        $response = $this->postJson('/api/auth/signup', $userData);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id', 'name', 'email', 'created_at'
                ],
            ]);

        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    /** @test */
    public function it_can_login_a_user()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $loginData = [
            'email' => 'test@example.com',
            'password' => 'password',
        ];

        $response = $this->postJson('/api/auth/login', $loginData);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'user' => [
                    'id', 'name', 'email', 'created_at'
                ],
                'token'
            ]);
    }

    /** @test **/
    public function it_can_logout_a_user()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => 'password',
        ]);
        $loginData = [
            'email' => 'test@example.com',
            'password' => 'password',
        ];
        $response = $this->postJson('/api/auth/login', $loginData);
        $token = JWTAuth::fromUser($user);

        $response2 = $this->withHeaders([
            'Authorization' => "Bearer {$token}",
        ])->postJson('/api/auth/logout');
        $response2->assertStatus(200);

    }

}
