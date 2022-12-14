<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class ContactThanks extends Mailable
{
    use Queueable, SerializesModels;

    private $mail_address;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail_address)
    {
        $this->mail_address = $mail_address;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->mail_address)->markdown('emails.contact.thanks');
    }
}
