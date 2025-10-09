<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class EmailTwoFactorCode extends Notification
{
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {   
        return (new MailMessage)
            ->subject('Your 2FA Code')
            ->line('Your 2-factor authentication code is: ' . $notifiable->email_2fa_code)
            ->line('This code will expire in 10 minutes.');
    }
}
