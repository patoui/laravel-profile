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

    public function testGetShortCreatedAtAttribute()
    {
        $timestamp = Carbon::parse('April 4th, 2019 11:11 AM');
        $comment = factory(Comment::class)->make(['created_at' => $timestamp]);

        $this->assertEquals(
            'Apr 4, 2019',
            $comment->short_created_at
        );
    }
}
