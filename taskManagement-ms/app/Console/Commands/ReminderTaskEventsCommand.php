<?php

namespace App\Console\Commands;


use App\Modules\TodoList\Models\Task;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
class ReminderTaskEventsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:events {test?}';

    /**
     * The console command description.com
     *
     * @var string
     */
    protected $description = 'This command reminds you of tasks that are due within the next 24 hours.';


    /**
     * Execute the console command.
     */
    public function handle()
    {
      
     if ($this->argument('test') == "test" ){
      $tasks = Task::get();
     }
      else {
      $tasks = Task::where('date_of_completion', '<=', now()->addDay())
        ->where('date_of_completion', '>=', now())
        ->get();
      }
    
        print_r($tasks);
      // Set prefix configuration
        \Config::set('database.redis.options.prefix', 'todo_authorization_database_');

        Redis::publish('reminder-task', json_encode(
        ['event'=> 'reminder-task',
                'data' =>$tasks]
            ));

      // Reset configuration
        \Config::set('database.redis.options.prefix', Str::slug(env('APP_NAME', 'laravel'), '_') . '_database_');
    }
}
