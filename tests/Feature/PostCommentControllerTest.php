<?php

namespace Tests\Feature;

use App\Comment;
use App\Post;
use App\User;
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
        $this->be($user = factory(User::class)->create());

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

    /**
     * Test storing a post comment failure when unauthenticated
     */
    public function testStoreUnauthenticated()
    {
        // Arrange
        $this->expectException(
            'Illuminate\Auth\AuthenticationException'
        );

        // Act
        $response = $this->post(
            'post/slug-here/comment',
            ['body' => 'Awesome post!']
        );
    }

    /**
     * Test storing a post comment failure when the post does not exists
     */
    public function testStorePostNotFound()
    {
        // Arrange
        $this->be($user = factory(User::class)->create());
        $this->expectException(
            'Illuminate\Database\Eloquent\ModelNotFoundException'
        );

        // Act
        $response = $this->post(
            'post/slug-here/comment',
            ['body' => 'Awesome post!']
        );
    }

    /**
     * Test storing a post comment on a comment
     */
    public function testStoreOnComment()
    {
        // Arrange
        $this->be($user = factory(User::class)->create());

        $post = factory(Post::class)->create([
            'title' => 'First Title',
            'body' => 'First Body',
            'slug' => 'first-title',
        ]);

        $comment = factory(Comment::class)->create([
            'post_id' => $post->id,
            'body' => 'Awesome post!',
        ]);

        // Act
        $response = $this->post(
            'post/' . $post->slug . '/comment',
            [
                'comment_id' => $comment->id,
                'body' => 'Sure was!'
            ]
        );

        // Assert
        $response->assertStatus(302)
            ->assertRedirect('post/' . $post->slug);

        $this->assertNotNull(
            Comment::where('post_id', $post->id)
                ->where('comment_id', $comment->id)
                ->where('body', 'Sure was!')
                ->first()
        );
    }
}
