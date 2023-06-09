<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use App\Mail\EmailManager;
use Auth;
use App\User;

class EmailVerificationNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $notifiable->verification_code = encrypt($notifiable->id);
        $notifiable->save();

        $array['view'] = 'emails.verification';
        $array['subject'] = translate('Email Verification');
        $array['content'] = translate('Please click the button below to verify your email address.');
        $array['link'] = route('email.verification.confirmation', $notifiable->verification_code);

        return (new MailMessage)
            ->view('emails.verification', ['array' => $array])
            ->subject(translate('Email Verification - ').env('APP_NAME'));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
