<?php

namespace App\Modules\TodoList\Listeners;

use App\Modules\TodoList\Events\ChangeStatusTaskEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

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
      \Config::set('database.redis.options.prefix', Str::slug(env('APP_NAME_AUTHORIZATION_MS', 'laravel'), '_') . '_database_');


        Redis::publish('change-status-task',
        json_encode(
            [
                'event' => 'change-status-task',
                'data' => $event
            ]
        ));
        \Config::set('database.redis.options.prefix', Str::slug(env('APP_NAME_AUTHORIZATION_MS', 'laravel'), '_') . '_database_');

    }
}
