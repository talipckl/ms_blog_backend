<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_all_posts()
    {
        $category = Category::factory()->create();
        $user = User::factory()->create();
        Post::factory()->count(5)->create(['user_id' => $user->id]);
        $response = $this->getJson('/api/post');
        $response->assertStatus(200)
            ->assertJsonCount(5, 'data');
    }

    /** @test */
    public function it_can_show_a_single_post()
    {
        $category = Category::factory()->create();
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $response = $this->getJson('/api/post/show/' . $post->slug);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'slug',
                    'title',
                    'content'
                ]
            ]);
    }

    /** @test */
    public function test_show_post_not_found()
    {
        $slug = "test-case-slug";
        $response = $this->getJson("api/post/show/{$slug}");

        $response->assertStatus(404)
            ->assertJson([
                'status' => false,
                'message' => 'Post Not Found!'
            ]);
    }

}
