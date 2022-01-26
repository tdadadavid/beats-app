<?php

namespace App\Providers;

use App\Notifications\WelcomeNotificationEmail;
use App\Providers\NewUserRegistration;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class NewUserEmailNotification
{


    public function __construct(NewUserRegistration $event)
    {

    }

    /**
     * Handle the event.
     *
     * @param  \App\Providers\NewUserRegistration  $event
     * @return void
     */
    public function handle(NewUserRegistration $event)
    {
        $event->user->notifyNow(new WelcomeNotificationEmail($event->user));
    }
}
