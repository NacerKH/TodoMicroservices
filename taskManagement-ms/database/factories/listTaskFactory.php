<?php

namespace Database\Factories;

use App\Modules\TodoList\Models\ListTask;
use Illuminate\Database\Eloquent\Factories\Factory;


class listTaskFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ListTask::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->name(),
        ];
    }
}
