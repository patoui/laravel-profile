<?php

namespace Tests\Feature;

use App\Comment;
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
}
