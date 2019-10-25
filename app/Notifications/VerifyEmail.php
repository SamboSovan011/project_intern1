<?php

namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;


class VerifyEmail extends VerifyEmailBase
{
    // public $input;


    // public function __construct(Request $request)
    // {
    //     $this->input = $request->all();

    //     if (empty($this->input['email'])) { $this->input['email'] = 'admin@site.ru'; }
    // }
    public function toMail($notifiable)
    {

        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }
        return (new MailMessage)
            ->subject(Lang::getFromJson('Welcome to Potted Pan!'))
            ->greeting('Hi, Newcomer!')
            ->line(Lang::getFromJson('We\'re kindly asking you to confirm your email address. Please verify it by click on the button below.'))
            ->action(
                Lang::getFromJson('Confirm Email'),
                $this->verificationUrl($notifiable)
            )
            ->line(Lang::getFromJson('If you did not create an account, no further action is required.'))
            ->line(Lang::getFromJson('Best Regard, '))
            ->salutation('Potted Pan Team');
    }


}
