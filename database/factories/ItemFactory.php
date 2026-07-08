<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->words(3, true),
            'category' => fake()->randomElement(['Electronics', 'Accessories', 'Documents', 'Pets', 'Keys', 'Other']),
            'status' => fake()->randomElement(['Lost', 'Found']),
            'description' => fake()->sentence(12),
            'location' => fake()->city(),
            'image' => 'https://picsum.photos/seed/'.fake()->uuid().'/640/480',
        ];
    }
}
