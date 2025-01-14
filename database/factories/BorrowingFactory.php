<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrowing>
 */
class BorrowingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_copy_id' => \App\Models\BookCopy::factory(),
            'user_id' => \App\Models\User::factory(),
            'borrowed_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'returned_at' => fake()->optional()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
