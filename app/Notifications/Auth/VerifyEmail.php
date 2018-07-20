<?php

namespace App\Notifications\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmail extends Notification
{
    use Queueable;


    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('You must verify your email address')
                    ->action('Verify email', $this->verificationUrl($notifiable));
    }

    protected function verificationUrl($notifiable)
    {
        return url()->temporarySignedRoute(
            'email.verify', now()->addMinutes(60), ['user' => $notifiable->getKey()]
        );
    }
}
