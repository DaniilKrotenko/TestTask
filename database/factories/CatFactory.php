<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cat>
 */
class CatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'shelter_id' => fake()->randomDigit(),
            'health' => fake()->randomElement(['Ok', 'No']),
            'arrival' => fake()->date(),
            'departure' => fake()->date(),
        ];
    }
}
