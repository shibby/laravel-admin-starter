<?php

namespace App\Listeners\Comment;

use App\Events\CommentApprovedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCommentRepliedEmailListener implements ShouldQueue
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
        $comment = $event->getComment();

        if ($comment->parent_comment_id && $comment->parentComment->user_id !== $comment->user_id) {
            //eğer üye kendi kendine yanıt vermiyorsa
        }
    }
}
