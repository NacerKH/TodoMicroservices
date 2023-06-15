<?php

namespace App\Modules\TodoList\Listeners;

use App\Modules\TodoList\Events\ChangeStatusTaskEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Redis;

class ChangeStatusTaskListener
{
   

    /**
     * Create the event listener.
     */
    public function __construct()
    {
      
    }

    /**
     * Handle the event.
     */
    public function handle(ChangeStatusTaskEvent $event): void
    {
        Redis::publish('change-status-task', json_encode($event));
    }
}
