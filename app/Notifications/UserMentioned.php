<?php

namespace App\Notifications;

use App\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UserMentioned extends Notification
{
    use Queueable;

    /** @var Comment */
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /** Get the notification's delivery channels */
    public function via() : array
    {
        return ['database'];
    }

    /** Get the array representation of the notification */
    public function toArray() : array
    {
        return [
            'message' => $this->comment->owner->name.' mentioned you in '.$this->comment->post->title,
            'link' => $this->comment->path
        ];
    }
}
