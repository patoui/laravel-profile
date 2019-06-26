<?php

declare(strict_types=1);

namespace App\Events;

use App\Comment;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentSaved
{
    use Dispatchable;
    use SerializesModels;

    /** @var Comment */
    public $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
}
