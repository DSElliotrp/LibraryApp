<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            ['name' => 'Fantasy'],
            ['name' => 'Science Fiction'],
            ['name' => 'Mystery'],
            ['name' => 'Thriller'],
            ['name' => 'Historical Fiction'],
            ['name' => 'Romance'],
            ['name' => 'Biography'],
            ['name' => 'Self-Help'],
            ['name' => 'Graphic Novels'],
            ['name' => 'Children\'s Books'],
            ['name' => 'Non-Fiction'],
        ];
        
        Genre::insert($genres);
    }
}
