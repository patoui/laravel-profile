<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex(): void
    {
        // Arrange
        $post = Post::factory()->published()->create();
        $unpublished = Post::factory()->create();

        // Act
        $response = $this->get('blog');

        // Assert
        $response->assertSuccessful();
        $response->assertSee(e($post->title));
        $response->assertDontSee(e($unpublished->title));
    }
}
