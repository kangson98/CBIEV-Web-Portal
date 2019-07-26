<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvestorRegistrationApprovalInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $recipient;
    public $url;
    public $investorName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recipient, $url, $investorName)
    {
        $this-> recipient = $recipient;
        $this-> url = $url;
        $this-> investorName = $investorName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this->markdown('markdown_mail.investor_regis_rec_invite');
    }
}
