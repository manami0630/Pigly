<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WeightLogFactory extends Factory
{
    protected $model = \App\Models\WeightLog::class;

    public function definition()
    {
        return [
            'user_id' => 1,
            'weight' => $this->faker->randomFloat(1, 40, 60),
            'date' => $this->faker->dateTimeBetween('-1 years'),
            'calories' => $this->faker->numberBetween(100, 3000),
            'exercise_time' => $this->faker->time(),
            'exercise_content' => $this->faker->sentence(3),
        ];
    }
}