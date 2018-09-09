<?php

namespace Tests\Unit;

use App\Comment;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function testOwner()
    {
        // Arrange
        factory(User::class)->states('me')->create();
        Mail::fake();
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();
        $comment = factory(Comment::class)->create([
            'post_id' => $post->id,
            'user_id' => $user->id,
        ]);

        // Act
        $owner = $comment->owner;

        // Assert
        $this->assertEquals($user->id, $owner->id);
    }

    public function testComments()
    {
        // Arrange
        factory(User::class)->states('me')->create();
        Mail::fake();
        $post = factory(Post::class)->create();
        $comment = factory(Comment::class)->create([
            'post_id' => $post->id
        ]);
        factory(Comment::class, 5)->create([
            'post_id' => $post->id,
            'comment_id' => $comment->id
        ]);

        // Act
        $comments = $comment->comments;

        // Assert
        $this->assertEquals(
            5,
            $comments->count()
        );
    }

    public function testGetShortTimestampAttribute()
    {
        $comment = factory(Comment::class)->make([
            'created_at' => '2017-02-02 06:06:06'
        ]);

        $this->assertEquals(
            'February 2nd 1:06 AM',
            $comment->short_timestamp
        );
    }

    public function testGetShortTimestampAttributeToday()
    {
        $timestamp = Carbon::now()->subSeconds(10);
        $comment = factory(Comment::class)->make([
            'created_at' => $timestamp
        ]);

        $this->assertEquals(
            '10 seconds ago',
            $comment->short_timestamp
        );
    }
}
