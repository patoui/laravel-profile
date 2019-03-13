<?php

namespace App\Notifications;

use App\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UserMentioned extends Notification
{
    use Queueable;

    /**
     * @var App\Comment
     */
    protected $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => $this->comment->owner->name.' mentioned you in '.$this->comment->post->title,
            'link' => $this->comment->path
        ];
    }
}
