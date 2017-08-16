<?php

namespace Tests\Unit;

use App\Comment;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

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
