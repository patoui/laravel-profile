<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UserMentioned extends Notification
{
    use Queueable;

    /** @var Comment */
    protected Comment $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /** @return array<string> */
    public function via() : array
    {
        return ['database'];
    }

    /** @return array<string, string|null> */
    public function toArray() : array
    {
        return [
            'message' => ($this->comment->owner->name ?? '')
                         . ' mentioned you in '
                         . ($this->comment->post->title ?? ''),
            'link' => $this->comment->path,
        ];
    }
}
