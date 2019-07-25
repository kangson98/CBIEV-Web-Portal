<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MentorRegistrationNotRecommendedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $registrantName;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($registrantName)
    {
        $this-> registrantName = $registrantName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('view.name');
    }
}
