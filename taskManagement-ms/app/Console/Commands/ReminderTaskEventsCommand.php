<?php

namespace App\Console\Commands;


use App\Modules\TodoList\Models\Task;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class ReminderTaskEventsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:events';

    /**
     * The console command description.com
     *
     * @var string
     */
    protected $description = 'task will remind you of the tasks that are due in the next 24 hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = Task::where('date_of_completion', '<=', now()->addDay())
            ->where('date_of_completion', '>=', now())
            ->get();
    print_r($tasks);
 
          Redis::publish('reminder-task', json_encode(
            ['event'=> 'reminder-task',
                    'data' =>$tasks]
                ));
        
    }
}
