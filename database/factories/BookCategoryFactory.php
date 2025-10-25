<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
        'Fiction', 'Science', 'Technology', 'History', 'Biography', 
        'Fantasy', 'Mystery', 'Romance', 'Thriller', 'Horror',
    ];

        return [
             'name' => fake()->randomElement($categories) . ' - ' . fake()->word(),
        ];
    }
}
