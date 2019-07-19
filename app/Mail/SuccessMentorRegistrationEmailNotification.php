<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SuccessMentorRegistrationEmailNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $recipient;
    public $mentorRegisID;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recipient, $mentorRegisID)
    {
        $this-> recipient = $recipient;
        $this-> mentorRegisID = $mentorRegisID;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('markdown_mail.mentor_regis_success')
                    ->subject('Successfull Mentor Registration!');
    }
}
