<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'name' => $this->faker->sentence,
            // 'price' => rand(100, 2000),
            // 'quantity' => rand( 10, 20),
            // 'image' => $this->faker->sentence,
            // 'author_id' => rand(1, 6),
        ];
    }
}
