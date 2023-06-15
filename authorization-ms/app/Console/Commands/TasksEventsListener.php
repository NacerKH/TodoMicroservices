<?php

namespace App\Console\Commands;

use App\Events\ReminderTaskEvent;
use App\Jobs\ReminderTaskJob;
use App\Models\User;
use App\Notifications\AssignedTaskNotification;
use App\Notifications\ChangeStatusTaskNotification;
use App\Notifications\ReminderTaskNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class TasksEventsListener extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:listener';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

    

        Redis::subscribe(['reminder-task', 'change-status-task', 'task-was-assigned'], function ($message) {

            $data = json_decode($message, true);
            print_r($data);
      
   
            switch ($data['event']) {
                case 'reminder-task':
                    $this->reminderTask($data['data'] );
                    break;
                case 'change-status-task':
                    $this->changeStatusTask($data['data']);
                    break;
                case 'task-was-assigned':
                    $this->taskWasAssigned($data['data']);
                    break;
            }
          
        });

    }


    private function reminderTask($tasks)
    {
        echo "reminderTask message: "  .PHP_EOL;
        foreach ($tasks as $task) {
        $user_id = $task['user_id'];
        $user = User::findOrfail($user_id);
        echo "Received message: " .  print_r($user) . "\n";
        $user->notify(new ReminderTaskNotification($task));
        }
    }

    private function changeStatusTask($tasks)
    {    echo "changeStatusTask message: "  . PHP_EOL;
        foreach ($tasks as $task) {
            $user_id = $task['user_id'];
            $user = User::findOrfail($user_id);
            echo "Received message: " .  print_r($user) . "\n";
           $user->notify(new ChangeStatusTaskNotification($task));
        }

    
        
    }

    private function taskWasAssigned($tasks)
    {
        echo "taskWasAssigned message: "  . PHP_EOL;
        foreach ($tasks as $task) {
            $user_id = $task['user_id'];
            $user = User::findOrfail($user_id);
            echo "Received message: " .  print_r($user) . "\n";
          $user->notify(new AssignedTaskNotification($task));

        }
    } 

   
}
