<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MentorRegistrationRecommendationInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $recipient;
    public $url;
    public $mentorName;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recipient, $url, $mentorName)
    {
        $this-> recipient = $recipient;
        $this-> url = $url;
        $this-> mentorName = $mentorName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this->markdown('markdown_mail.mentor_regis_rec_invite');
    }
}
