<?php

namespace Tests\Unit;

use App\Comment;
use App\Post;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function testComments()
    {
        // Arrange
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
