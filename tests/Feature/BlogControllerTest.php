<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to display a list of post
     *
     * @return void
     */
    public function testIndex()
    {
        // Arrange
        $post = factory(Post::class)->states(['published'])->create();
        $unpublished = factory(Post::class)->create();

        // Act
        $response = $this->get('blog');

        // Assert
        $response->assertStatus(200);
        $response->assertSee($post->title);
        $response->assertDontSee($unpublished->title);
    }
}
