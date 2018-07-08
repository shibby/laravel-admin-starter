<?php

namespace App\Providers;

use App\Events\CommentApprovedEvent;
use App\Events\CommentSavedEvent;
use App\Events\UserLoggedInEvent;
use App\Events\UserRegisteredEvent;
use App\Listeners\Comment\SendCommentApprovedEmailListener;
use App\Listeners\UserLoginTrackListener;
use App\Listeners\UserRegistered\SendWelcomeEmailListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserRegisteredEvent::class => [
            UserLoginTrackListener::class,
            SendWelcomeEmailListener::class,
        ],
        UserLoggedInEvent::class => [
            UserLoginTrackListener::class,
        ],
        CommentSavedEvent::class => [
        ],
        CommentApprovedEvent::class => [
            SendCommentApprovedEmailListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot()
    {
        parent::boot();
    }
}
