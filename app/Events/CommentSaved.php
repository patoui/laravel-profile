<?php

declare(strict_types=1);

namespace App\Events;

use App\Comment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

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
