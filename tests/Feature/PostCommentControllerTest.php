<?php

namespace Tests\Feature;

use App\Activity;
use App\Comment;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class PostCommentControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test storing a post comment
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

        // Act
        $response = $this->post(
            'post/' . $post->slug . '/comment',
            ['body' => 'Awesome post!']
        );

        // Assert
        $response->assertStatus(302)
            ->assertRedirect('post/' . $post->slug);

        // Assert activity was recorded
        $comment = app(Comment::class)->where('post_id', $post->id)->first();
        $this->assertNotNull(
            app(Activity::class)->where([
                'type' => 'created_comment',
                'subject_id' => $comment->id,
                'subject_type' => get_class($comment),
            ])->first()
        );
    }

    /**
     * Test storing a post comment failure when unauthenticated
     */
    public function testStoreUnauthenticated()
    {
        // Arrange
        $this->expectException('Illuminate\Auth\AuthenticationException');

        // Act
        $response = $this->post(
            'post/slug-here/comment',
            ['body' => 'Awesome post!']
        );

        // Assert activity was not recorded
        $this->assertNotNull(app(Activity::class)->first());
    }

    /**
     * Test storing a post comment failure when the post does not exists
     */
    public function testStorePostNotFound()
    {
        // Arrange
        factory(User::class)->states('me')->create();
        Mail::fake();
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
        factory(User::class)->states('me')->create();
        Mail::fake();
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

    /**
     * Test storing a post comment and `@` a user and triggers a notification
     */
    public function testStoreNotifyMentionedUser()
    {
        // Arrange
        factory(User::class)->states('me')->create();
        Mail::fake();
        $john = factory(User::class)->create(['name' => 'johndoe']);
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $post = factory(Post::class)->create([
            'title' => 'First Title',
            'body' => 'First Body',
            'slug' => 'first-title',
        ]);

        // Act
        $response = $this->post('post/' . $post->slug . '/comment', [
            'body' => 'Great post @johndoe!'
        ]);

        // Assert
        $response->assertStatus(302)
            ->assertRedirect('post/' . $post->slug);

        $this->assertNotNull(
            Comment::where('post_id', $post->id)
                ->where('body', 'Great post @johndoe!')
                ->first()
        );

        $this->assertCount(1, $john->notifications);
    }
}
