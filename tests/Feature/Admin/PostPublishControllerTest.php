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
    public function testShow()
    {
        // Arrange
        $user = factory(User::class)->create();

        $post = factory(Post::class)->create(['published_at' => null]);

        // Act
        $response = $this->actingAs($user)
            ->get('admin/post/' . $post->id . '/publish');

        // Assert
        $response->assertStatus(302);

        $this->assertNotNull($post->fresh()->published_at);
    }
}
