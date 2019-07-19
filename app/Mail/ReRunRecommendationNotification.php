<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReRunRecommendationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $rerun = true;
    public $recipient;
    public $projectTitle;
    public $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recipient, $projectTitle ,$url)
    {
        $this-> recipient = $recipient;
        $this-> projectTitle = $projectTitle;
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
