<?php

namespace App\Listeners;

use App\Events\StatEvent;
use App\Model\BlogContent;
use App\Service\StatService;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;

class StatEventListener implements ShouldQueue
{
    /**
     * @var StatService
     */
    private $statService;

    /**
     * Create the event listener.
     *
     * @param StatService $statService
     */
    public function __construct(StatService $statService)
    {
        $this->statService = $statService;
    }

    /**
     * Handle the event.
     *
     * @param StatEvent $event
     */
    public function handle(StatEvent $event)
    {
        $model = $event->getModel();
        $blogContent = $model instanceof BlogContent ? $model : null;
        $user = $model instanceof User ? $model : null;

        $this->statService->insertStat(
            $user, $blogContent,
            $event->getAction()
        );

        if (
            StatEvent::ACTION_VIEW === $event->getAction() &&
            ($event->getModel() instanceof BlogContent)
        ) {
            ++$event->getModel()->total_view_count;
            $event->getModel()->save();
        }
    }
}
