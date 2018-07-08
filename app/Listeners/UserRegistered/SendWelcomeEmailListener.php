<?php

namespace App\Listeners\UserRegistered;

use App\Events\UserRegisteredEvent;
use App\Notifications\User\SendWelcomeEmailNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmailListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param UserRegisteredEvent $event
     */
    public function handle(UserRegisteredEvent $event)
    {
        //$event->getUser()->notify(new SendWelcomeEmailNotification());
    }
}
