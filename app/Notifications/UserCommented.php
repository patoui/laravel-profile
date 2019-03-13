<?php

namespace App\Notifications;

use App\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class UserCommented extends Notification
{
    use Queueable;

    /**
     * @var Comment
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Someone commented on \''.$this->comment->post->title.'\'!')
            ->greeting('Someone commented on \''.$this->comment->post->title.'\'!')
            ->action(
                'Click here to view it',
                url($this->comment->path)
            )
            ->line('Comment contents:')
            ->line($this->comment->body);
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
            //
        ];
    }
}
