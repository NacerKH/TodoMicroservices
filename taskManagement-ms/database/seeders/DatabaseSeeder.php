<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Modules\TodoList\Models\ListTask;
use App\Modules\TodoList\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
     ListTask::factory()->count(10)->create();
     Task::factory()->count(10)->create();
    }
}
