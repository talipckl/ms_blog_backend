<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class PostCrudTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic Post  feature test example.
     */
    /** @test */

    public function test_post_creation()
    {
        $category = Category::factory()->create();
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);
        $postData = [
            'category_id' =>$category->id,
            'title' => 'Test Post Title',
            'content' => 'Test Post Content',
        ];
        $response = $this->withHeaders([
            'Authorization' => "Bearer {$token}",
        ])->postJson('/api/post', $postData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('posts', [
            'user_id' => $user->id,
            'category_id' => $postData['category_id'],
            'title' => $postData['title'],
            'content' => $postData['content'],
        ]);
    }

    /** @test */
    public function it_can_update_an_existing_post()
    {
        $category = Category::factory()->create();
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);
        $post = Post::factory()->create();

        $updateData = [
            'title' => 'Updated Post Title',
            'content' => 'Updated content.'
        ];

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$token}",
        ])->putJson('/api/post/update/' . $post->id, $updateData);

        $response->assertStatus(200)
            ->assertJsonFragment($updateData);
    }

    /** @test */
    public function it_can_delete_a_post()
    {
        $category = Category::factory()->create();
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);
        $post = Post::factory()->create();
        $response = $this->withHeaders([
            'Authorization' => "Bearer {$token}",
        ])->deleteJson('/api/post/delete/' . $post->id);

        $response->assertStatus(200);
        $this->assertSoftDeleted('posts', ['id' => $post->id]);
    }
}
