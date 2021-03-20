<?php

namespace Tests\Feature;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class CommentFavouriteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStore(): void
    {
        // Arrange
        User::factory()->me()->create();
        Mail::fake();
        $this->be($user = User::factory()->create());

        $post = Post::factory()->create([
            'title' => 'First Title',
            'body' => 'First Body',
            'slug' => 'first-title',
        ]);

        $comment = Comment::factory()->create(['post_id' => $post->id]);

        // Act
        $response = $this->post('comment/' . $comment->id, [
            'post_slug' => $post->slug,
            'comment' => $comment->id,
        ]);

        // Assert
        $response->assertStatus(302)->assertRedirect('post/' . $post->slug);

        // Assert comment was saved to the user
        self::assertNotNull($user->fresh()->favourites()->first());
    }
}
