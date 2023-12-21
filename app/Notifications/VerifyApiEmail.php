<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class VerifyApiEmail extends Notification
{
    public function toMail($notifiable)
    {
        $url = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60), // Token expiration time
            ['id' => $notifiable->getKey()]
        );

        return (new MailMessage)
            ->line('Please click the button below to verify your email address.')
            ->action('Verify Email', url($url))
            ->line('If you did not create an account, no further action is required.');
    }
}
