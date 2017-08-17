<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to display the post title and body.
     */
    public function testShow()
    {
        // Arrange
        $post = factory(Post::class)->create([
            'title' => 'First Title',
            'body' => 'First Body',
            'slug' => 'first-title',
        ]);

        // Act
        $response = $this->get('post/' . $post->slug);

        // Assert
        $response->assertStatus(200)
            ->assertSee('First Title')
            ->assertSee('First Body');
    }
}
