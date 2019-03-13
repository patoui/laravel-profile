<?php

namespace App\Events;

use App\Comment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class CommentSaved
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
}
