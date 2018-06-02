<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to display the post title and body.
     */
    public function testShow()
    {
        // Arrange
        $previousPost = factory(Post::class)->create([
            'title' => 'First Title',
            'body' => 'First Body',
            'slug' => 'first-title',
            'published_at' => Carbon::now()->subDays(2),
        ]);
        $post = factory(Post::class)->create([
            'title' => 'Second Title',
            'body' => 'Second Body',
            'slug' => 'second-title',
            'published_at' => Carbon::now()->subDay(),
        ]);
        $nextPost = factory(Post::class)->create([
            'title' => 'Third Title',
            'body' => 'Third Body',
            'slug' => 'third-title',
            'published_at' => Carbon::now(),
        ]);

        // Act
        $response = $this->get('post/' . $post->slug);

        // Assert
        $response->assertStatus(200)
            ->assertSee('Second Title')
            ->assertSee('Second Body')
            ->assertSee('Previous: First Title')
            ->assertSee('Next: Third Title');

        // Assert analytics were stored
        $this->assertNotNull(
            $post->fresh()->analytics()->first()
        );
    }
}
