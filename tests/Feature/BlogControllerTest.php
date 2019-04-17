<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        // Arrange
        $post = factory(Post::class)->states('published')->create();
        $unpublished = factory(Post::class)->create();

        // Act
        $response = $this->get('blog');

        // Assert
        $response->assertSuccessful();
        $response->assertSee($post->title);
        $response->assertDontSee($unpublished->title);
    }
}
