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

    


        Redis::subscribe('reminder-task', function ($message) {

            $data = json_decode($message, true);
            print_r($data);
            foreach ($data as $task) {
                $user_id = $task['user_id'];
                $user = User::findOrfail($user_id);

                echo "Received message: " .  print_r($user) . "\n";
                $user->notify(new ReminderTaskNotification($task));
                echo "Received message: " . $task['user_id'] . "\n";
            }
        });

        Redis::subscribe('change-status-task', function ($message) {

            $data = json_decode($message, true);
            print_r($data);

            foreach ($data as $task) {
                $user_id = $task['user_id'];
                $user = User::findOrfail($user_id);

                // echo "Received message: " .  print_r($user) . "\n";
                $user->notify(new AssignedTaskNotification($task));
                echo "Received message: " . $task['user_id'] . "\n";
            }
        });

        Redis::subscribe('task-was-assigned', function ($message) {

            $data = json_decode($message, true);


            foreach ($data as $task) {
                $user_id = $task['user_id'];
                $user = User::findOrfail($user_id);

                // echo "Received message: " .  print_r($user) . "\n";
                $user->notify(new ChangeStatusTaskNotification($task));
                echo "Received message: " . $task['user_id'] . "\n";
            }
        });
    }
}
