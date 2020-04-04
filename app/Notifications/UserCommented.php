<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Routing\UrlGenerator;
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
        $title = $this->comment->post->title ?? '';
        return (new MailMessage())
            ->subject('Someone commented on \'' . $title . '\'!')
            ->greeting('Someone commented on \'' . $title . '\'!')
            ->action(
                'Click here to view it',
                app(UrlGenerator::class)->to(($this->comment->path ?? ''))
            )
            ->line('Comment contents:')
            ->line($this->comment->body);
    }
}
