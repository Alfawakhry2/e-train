<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titles = ['Web Development', 'Data Science', 'Digital Marketing', 'Languages', 'Design'];
        return [
            'title'=>fake()->unique()->randomElement($titles),
            'small_desc' =>fake()->sentence(2),
            'desc' =>fake()->paragraph(3 ,true),
            'image' =>fake()->imageUrl(640, 480, 'cats', true),
        ];
    }
}
