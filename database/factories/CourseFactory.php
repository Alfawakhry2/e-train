<?php

namespace Database\Factories;

use App\Models\Trainer;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('now', '+1 month');

        return [
            'title' => $this->faker->sentence(3),
            'code'  => Str::random(6),
            'small_desc'  => fake()->sentence(),
            'desc'  => fake()->paragraph(3,true),
            'price'  => fake()->numberBetween(4000,8000),
            'image'  => fake()->imageUrl(640, 480, 'cats', true),
            'duration'  => fake()->numberBetween(30 , 180),
            'start_date'  => $startDate,
            'end_date'  => fake()->dateTimeBetween($startDate , '+3 months'),
        ];
    }
}
