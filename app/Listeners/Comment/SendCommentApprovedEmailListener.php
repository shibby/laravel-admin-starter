<?php

namespace App\Listeners\Comment;

use App\Events\CommentApprovedEvent;
use App\Notifications\Comment\CommentApprovedNotification;
use App\Notifications\Comment\CommentRepliedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCommentApprovedEmailListener implements ShouldQueue
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
     * @param CommentApprovedEvent $event
     */
    public function handle(CommentApprovedEvent $event)
    {
        $user = $event->getComment()->user;

        /*$user->notify(
            new CommentApprovedNotification($event->getComment())
        );

        if ($event->getComment()->parent_comment_id) {
            $event->getComment()->parentComment->user->notify(
                new CommentRepliedNotification($event->getComment())
            );
        }*/
    }
}
