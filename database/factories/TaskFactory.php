<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(4),
            'description' => $this->faker->text(),
            'priority' => $this->faker->randomElement(['низкий', 'средний', 'высокий']),
            'created_user_id' => User::inRandomOrder()->first()->id,
            'executor_user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
