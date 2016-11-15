<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMe extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $phone;
    public $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $phone, $comment)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'patrique.ouimet@gmail.com';
        $name = 'no-reply';
        $subject = 'Contact Request';

        return $this->view('emails.contact-me')
            ->from($address, $name)
            ->subject($subject)
            ->with('name', $this->name)
            ->with('email', $this->email)
            ->with('phone', $this->phone)
            ->with('comment', $this->comment);
    }
}
