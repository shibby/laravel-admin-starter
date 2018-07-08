<?php

namespace App\Listeners\UserFollower;

use App\Events\UserFollower\UserFollowedEvent;
use App\Notifications\UserFollower\NewFollowerNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewFollowerNotificationListener implements ShouldQueue
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
     * @param UserFollowedEvent $event
     */
    public function handle(UserFollowedEvent $event)
    {
        $followingUser = $event->getFollowingUser();
        $follower = $event->getUser();

        $followingUser->notify(new NewFollowerNotification(
            $follower
        ));
    }
}
