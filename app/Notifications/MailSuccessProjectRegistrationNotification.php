<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MailSuccessProjectRegistrationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $recipient;
    protected $projectName;
    protected $trackingNO;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($recipient, $projectName, $trackingNO)
    {
        $this-> recipient = $recipient;
        $this-> projectName = $projectName;
        $this-> trackingNO = $trackingNO;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Sucessful Idea/Project Registration')
                    ->greeting('Hello' . $this-> recipient)
                    ->line('Your Idea/Project ' . $this-> projectName . 'has been register.')
                    ->line('Your Project Registration Tracking Number is ' .$this-> trackingNO)
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
