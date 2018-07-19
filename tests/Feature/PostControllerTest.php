<?php

namespace Tests\Feature;

use App\Comment;
use App\Post;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
        $comment = factory(Comment::class)->create([
            'post_id' => $post->id,
            'body' => 'This is a sweet post!',
        ]);

        // Act
        $response = $this->get('post/' . $post->slug);

        // Assert
        $response->assertSuccessful()
            ->assertSee('Second Title')
            ->assertSee('Second Body')
            ->assertSee('Previous: First Title')
            ->assertSee('Next: Third Title')
            ->assertSee($comment->body)
            ->assertSee('id="comment' . $comment->id . '"');

        // Assert analytics were stored
        $this->assertNotNull(
            $post->fresh()->analytics()->first()
        );
    }
}
