<?php

namespace Tests\Feature;

use App\Activity;
use App\Comment;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\AuthenticationException;

class PostCommentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStore(): void
    {
        // Arrange
        User::factory()->me()->create();
        Mail::fake();
        $this->actingAs($user = User::factory()->create());

        $post = Post::factory()->create([
            'title' => 'First Title',
            'body'  => 'First Body',
            'slug'  => 'first-title',
        ]);

        // Act
        $response = $this->post(
            'post/' . $post->slug . '/comment',
            ['body' => 'Awesome post!']
        );

        // Assert
        $response->assertRedirect('post/' . $post->slug);

        // Assert activity was recorded
        $comment = Comment::where('post_id', $post->id)->first();
        self::assertNotNull($comment);
        self::assertNotNull(
            Activity::where([
                'type'         => 'created_comment',
                'subject_id'   => $comment->id,
                'subject_type' => get_class($comment),
            ])->first()
        );
    }

    /**
     * Test storing a post comment failure when unauthenticated
     */
    public function testStoreUnauthenticated(): void
    {
        // Arrange
        $this->expectException(AuthenticationException::class);

        // Act
        $this->post(
            'post/slug-here/comment',
            ['body' => 'Awesome post!']
        );

        // Assert activity was not recorded
        self::assertNotNull(app(Activity::class)->first());
    }

    /**
     * Test storing a post comment failure when the post does not exists
     */
    public function testStorePostNotFound(): void
    {
        // Arrange
        User::factory()->me()->create();
        Mail::fake();
        $this->be($user = User::factory()->create());
        $this->expectException(NotFoundHttpException::class);

        // Act
        $this->post(
            'post/slug-here/comment',
            ['body' => 'Awesome post!']
        );
    }

    /**
     * Test storing a post comment on a comment
     */
    public function testStoreOnComment(): void
    {
        // Arrange
        User::factory()->me()->create();
        Mail::fake();
        $this->be($user = User::factory()->create());

        $post = Post::factory()->create([
            'title' => 'First Title',
            'body'  => 'First Body',
            'slug'  => 'first-title',
        ]);

        $comment = Comment::factory()->create([
            'post_id' => $post->id,
            'body'    => 'Awesome post!',
        ]);

        // Act
        $response = $this->post(
            'post/' . $post->slug . '/comment',
            [
                'comment_id' => $comment->id,
                'body'       => 'Sure was!',
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

    /**
     * Test storing a post comment and `@` a user and triggers a notification
     */
    public function testStoreNotifyMentionedUser(): void
    {
        // Arrange
        User::factory()->me()->create();
        Mail::fake();
        $john = User::factory()->create(['name' => 'johndoe']);
        $user = User::factory()->create();
        $this->actingAs($user);

        $post = Post::factory()->create([
            'title' => 'First Title',
            'body'  => 'First Body',
            'slug'  => 'first-title',
        ]);

        // Act
        $response = $this->post('post/' . $post->slug . '/comment', [
            'body' => 'Great post @johndoe!',
        ]);

        // Assert
        $response->assertRedirect('post/' . $post->slug);

        $this->assertNotNull(
            Comment::where('post_id', $post->id)
                   ->where('body', 'Great post @johndoe!')
                   ->first()
        );

        $this->assertCount(1, $john->notifications);
    }
}
