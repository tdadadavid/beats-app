<?php

namespace App\Providers;

use App\Notifications\VerifyEmailNotification;
use App\Providers\VerificationCodeResend;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ResendEmailVerificationCode
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Providers\VerificationCodeResend  $event
     * @return void
     */
    public function handle(VerificationCodeResend $event)
    {
        $event->user->notifyNow(new VerifyEmailNotification($event->user));
    }
}
