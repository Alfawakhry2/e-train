<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trainer>
 */
class TrainerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'user_id' => fake()->numberBetween(1, User::count()),
            'spec' => fake()->jobTitle(),
            'desc' => fake()->paragraph(2 , true),
            'salary' => fake()->numberBetween(8000,15000),
            'experience' => fake()->numberBetween(1, 7),
            'status' => fake()->randomElement(['active' , 'inactive']),
        ];
    }
}
