<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostCommentControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test storing a post comment
     */
    public function testStore()
    {
        // Arrange
        $post = factory(Post::class)->create([
            'title' => 'First Title',
            'body' => 'First Body',
            'slug' => 'first-title',
        ]);

        // Act
        $response = $this->post(
            'post/' . $post->slug . '/comment',
            ['body' => 'Awesome post!']
        );

        // Assert
        $response->assertStatus(302)
            ->assertRedirect('post/' . $post->slug);
    }
}
