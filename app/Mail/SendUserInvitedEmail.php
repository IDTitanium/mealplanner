<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendUserInvitedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $familyName;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($familyName, $link)
    {
        $this->familyName = $familyName;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.join-family');
    }
}
