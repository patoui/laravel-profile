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

    public function testOwner(): void
    {
        // Arrange
        User::factory()->me()->create();
        Mail::fake();
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $comment = Comment::factory()->create([
            'post_id' => $post->id,
            'user_id' => $user->id,
        ]);

        // Act
        $owner = $comment->owner;

        // Assert
        $this->assertEquals($user->id, $owner->id);
    }

    public function testGetShortCreatedAtAttribute(): void
    {
        $timestamp = Carbon::parse('April 4th, 2019 11:11 AM');
        $comment = Comment::factory()->make(['created_at' => $timestamp]);

        self::assertEquals(
            'Apr 4, 2019',
            $comment->short_created_at
        );
    }
}
