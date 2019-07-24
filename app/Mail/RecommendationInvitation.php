<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RecommendationInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $recipient;
    public $url;
    public $regisType;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recipient, $url, $regisType)
    {
        $this-> recipient = $recipient;
        $this-> url = $url;
        $this-> regisType = $regisType;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this->markdown('markdown_mail.regis_rec_invite');
    }
}
