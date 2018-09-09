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

    /**
     * Store favouriting a comment
     *
     * @return void
     */
    public function testStore()
    {
        // Arrange
        factory(User::class)->states('me')->create();
        Mail::fake();
        $this->be($user = factory(User::class)->create());

        $post = factory(Post::class)->create([
            'title' => 'First Title',
            'body' => 'First Body',
            'slug' => 'first-title',
        ]);

        $comment = factory(Comment::class)->create([
            'post_id' => $post->id
        ]);

        // Act
        $response = $this->post(
            'comment/' . $comment->id,
            [
                'slug' => $post->slug,
                'comment' => $comment->id,
            ]
        );

        // Assert
        $response->assertStatus(302)
            ->assertRedirect('post/' . $post->slug);

        // Assert comment was saved to the user
        $this->assertNotNull($user->fresh()->favourites()->first());
    }
}
