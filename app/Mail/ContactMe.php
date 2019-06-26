<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMe extends Mailable
{
    use Queueable;
    use SerializesModels;

    /** @var string */
    public $name;

    /** @var string */
    public $email;

    /** @var string */
    public $phone;

    /** @var string */
    public $comment;

    public function __construct(string $name, string $email, string $phone, string $comment)
    {
        $this->name    = $name;
        $this->email   = $email;
        $this->phone   = $phone;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() : self
    {
        $address = 'patrique.ouimet@gmail.com';
        $name    = 'no-reply';
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
