<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use function url;

class UserCommented extends Notification
{
    use Queueable;

    /** @var Comment */
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /** @return array<string> */
    public function via() : array
    {
        return ['mail'];
    }

    public function toMail() : MailMessage
    {
        return (new MailMessage())
            ->subject('Someone commented on \'' . $this->comment->post->title . '\'!')
            ->greeting('Someone commented on \'' . $this->comment->post->title . '\'!')
            ->action(
                'Click here to view it',
                url($this->comment->path)
            )
            ->line('Comment contents:')
            ->line($this->comment->body);
    }
}
