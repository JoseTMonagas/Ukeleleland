<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($from, $name, $message)
    {
        $this->subject = $from;
        $this->name = $name;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = $this->name;
        $message = $this->message;
        return $this->from($this->subject)
                    ->markdown('emails.contact')
                    ->with(compact('name', 'message'));
    }
}
