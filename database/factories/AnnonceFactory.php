<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Annonce>
 */
class AnnonceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->realText(50),
            'city' => fake()->city(),
            'country' => fake()->country(),
            'disponibility' => fake()->date(),
            'equipements' => fake()->sentence(10),
            'price' => 999.99,
            'user_id' => 3,
            'category_id' => fake()->numberBetween(16, 22),
        ];
    }
}
