<?php

namespace App\Modules\TodoList\Listeners;

use App\Modules\TodoList\Events\AssignedTaskEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Redis;

class AssignedTaskListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AssignedTaskEvent $event): void
    {
        Redis::publish('task-was-assigned', json_encode(
            [
                'event' => 'task-was-assigned',
                'data' => $event
            ]
        ));
    }
}
