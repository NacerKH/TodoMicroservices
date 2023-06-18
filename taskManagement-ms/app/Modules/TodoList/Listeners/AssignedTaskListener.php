<?php

namespace App\Modules\TodoList\Listeners;

use App\Modules\TodoList\Events\AssignedTaskEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

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
            // Set the Redis prefix to include the authorization microservice name
         \Config::set('database.redis.options.prefix', Str::slug(env('APP_NAME_AUTHORIZATION_MS', 'laravel'), '_') . '_database_');

         // Publish the task-was-assigned event to Redis
        Redis::publish('task-was-assigned', json_encode(
            [
                'event' => 'task-was-assigned',
                'data' => $event
            ]
        ));
        // Reset the Redis prefix to the default value
        \Config::set('database.redis.options.prefix', Str::slug(env('APP_NAME', 'laravel'), '_') . '_database_');


    }
}
