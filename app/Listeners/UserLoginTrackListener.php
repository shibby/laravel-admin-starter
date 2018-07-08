<?php

namespace App\Listeners;

use App\Events\UserLoggedInEvent;
use App\Events\UserRegisteredEvent;
use App\Model\UserLogin;
use App\Service\UserLoginService;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserLoginTrackListener implements ShouldQueue
{
    /**
     * @var UserLoginService
     */
    private $userLoginService;

    /**
     * Create the event listener.
     *
     * @param UserLoginService $userLoginService
     */
    public function __construct(UserLoginService $userLoginService)
    {
        $this->userLoginService = $userLoginService;
    }

    /**
     * Handle the event.
     *
     * @param UserRegisteredEvent|UserLoggedInEvent $event
     */
    public function handle($event)
    {
        $action = UserLogin::ACTION_LOGIN;
        if ($event instanceof UserRegisteredEvent) {
            $action = UserLogin::ACTION_REGISTER;
        }
        $this->userLoginService->insertUserLogin($event->getUser(), $action, $event->getIpAddress(), $event->getUserAgent());
    }
}
