<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SuccessProjectRegistrationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $recipient;
    public $projectName;
    public $trackingNO;
    public $url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($recipient, $projectName, $trackingNO)
    {
        $this-> url = route('project.registration.login');
        $this-> recipient = $recipient;
        $this-> projectName = $projectName;
        $this-> trackingNO = $trackingNO;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('markdown_mail.project_regis_success')
                    ->subject('Successfull Project Registration!');
    }
}
