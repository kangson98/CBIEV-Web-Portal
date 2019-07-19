<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProjectRegistrationRecommendationInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $recipient;
    public $url;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recipient, $url)
    {
        $this-> recipient = $recipient;
        $this-> url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        
        return $this->markdown('markdown_mail.project_regis_rec_invite');
    }
}
