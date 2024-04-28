<?php

namespace Database\Factories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    protected $model = Player::class;

    public function definition()
    {
        return [
            'number' => $this->faker->unique()->numberBetween(1, 99),
            'name' => $this->faker->name(),
            'height' => $this->faker->randomFloat(2, 5, 7),
            'position' => $this->faker->randomElement(['1', '2', '3', '4', '5']),
            'weight' => $this->faker->randomFloat(2, 150, 300),
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}
