<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'like' => fake()->randomNumber(),
            'description' => fake()->text(),
            'file' => fake()->imageUrl(),
            'tags' => json_encode(['none' => 'none']),
            'user_id' => 1,
        ];
    }
}
