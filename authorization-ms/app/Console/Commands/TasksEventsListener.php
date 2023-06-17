<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\AssignedTaskNotification;
use App\Notifications\ChangeStatusTaskNotification;
use App\Notifications\ReminderTaskNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

/**
 * The TasksEventsListener class is responsible for listening to task-related events through Redis and performing actions based on the received events.
 */
class TasksEventsListener extends Command
{
   
   
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:listen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen to task-related events';

    /**
     * Execute the console command.
     */
    public function handle()
    {   

      Redis::connection('publisher')->subscribe(['reminder-task', 'change-status-task', 'task-was-assigned'], function ($message) {

            $data = json_decode($message, true);
            print_r($data);
            info($data);
      
   
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

    /**
     * Send reminder notifications for tasks.
     *
     * @param  array  $tasks  The tasks to send reminders for.
     * @return void
     */
    private function reminderTask($tasks)
    {
        echo "reminderTask message: "  .PHP_EOL;
        foreach ($tasks as $task) {
        $user_id = $task['user_id'];
        $user = User::findOrfail($user_id);
        echo "Received message: " .  print_r($user?->name) . "\n";
  
        $user->notify(new ReminderTaskNotification($task));
        }
    }
    /**
     * Send notifications for task status changes.
     *
     * @param  array  $tasks  The tasks with status changes.
     * @return void
     */
    private function changeStatusTask($tasks)
    {    echo "changeStatusTask message: "  . PHP_EOL;
        foreach ($tasks as $task) {
            $user_id = $task['user_id'];
            $user = User::findOrfail($user_id);
            echo "Received message: " .  print_r($user?->name) . "\n";
           $user->notify(new ChangeStatusTaskNotification($task));
        }

    
        
    }
    /**
     * Send notifications for assigned tasks.
     *
     * @param  array  $tasks  The tasks that were assigned.
     * @return void
     */
    private function taskWasAssigned($tasks)
    {
        echo "taskWasAssigned message: "  . PHP_EOL;
        foreach ($tasks as $task) {
            $user_id = $task['user_id'];
            $user = User::findOrfail($user_id);
            echo "Received message: " .  print_r($user?->name) . "\n";
          $user->notify(new AssignedTaskNotification($task));

        }
    } 

   
}
