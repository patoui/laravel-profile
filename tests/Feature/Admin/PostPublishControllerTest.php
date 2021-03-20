<?php

namespace Tests\Feature\Admin;

use App\Post;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostPublishControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to publish a post
     */
    public function testShow(): void
    {
        // Arrange
        $user = User::factory()->admin()->create();

        $post = Post::factory()->create(['published_at' => null]);

        // Act
        $response = $this->actingAs($user)
            ->get('admin/post/' . $post->id . '/publish');

        // Assert
        $response->assertStatus(302);

        $this->assertNotNull($post->fresh()->published_at);
    }
}
