<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookCopy;
use App\Models\Borrowing;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::factory(30)->create()->each(function ($book) {
            // Create 1-3 book copies for each book
            BookCopy::factory(rand(1, 3))->create(['book_id' => $book->id])->each(function ($bookCopy) {
                // Conditionally create a borrowing for each book copy
                if (rand(0, 1)) {
                    Borrowing::factory()->create(['book_copy_id' => $bookCopy->id]);
                }
            });

            $book->genres()->attach(rand(1, 11));
            $book->genres()->attach(rand(1, 11));
        });
    }
}
