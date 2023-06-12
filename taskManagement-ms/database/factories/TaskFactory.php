<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Modules\TodoList\Models\Task;
class TaskFactory extends Factory
{
    
    
    protected $model = Task::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>$this->faker->title(),
            'content'=>$this->faker->text(),
            'priority'=>$this->faker->numberBetween(1,5),
            'date_of_completion'=>$this->faker->dateTime(),
            'list_task_id'=>$this->faker->numberBetween(1,10),
            'user_id' => $this->faker->numberBetween(1, 10), 
        ];
    }
}
