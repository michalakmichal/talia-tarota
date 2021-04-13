<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SessionStartedMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $name;
    protected $body;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->name = $data['name'];
        $this->body = $data['body'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.mail', ['name' => $this->name, 'body' => $this->body])
        ->from('bok.codeservices@gmail.com','Test Mail');
    }
}
