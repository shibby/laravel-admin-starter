<?php

namespace App\Listeners\UserFollower;

use App\Events\UserFollower\UserFollowedEvent;
use App\Events\UserFollower\UserFollowRemovedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateCountsListener implements ShouldQueue
{
    public function __construct()
    {
    }

    /**
     * @param UserFollowedEvent|UserFollowRemovedEvent $event
     */
    public function handle($event)
    {
        $user = $event->getUser();
        $followingUser = $event->getFollowingUser();

        \DB::beginTransaction();
        if ($event instanceof UserFollowedEvent) {
            ++$user->following_count;
            $user->save();

            ++$followingUser->follower_count;
            $followingUser->save();
        } elseif ($event instanceof UserFollowRemovedEvent) {
            --$user->following_count;
            $user->save();

            --$followingUser->follower_count;
            $followingUser->save();
        }
        \DB::commit();
    }
}
