<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCopy;

class CopyController extends Controller
{
    public function destroy(Book $book, BookCopy $copy)
    {
        $copy->delete();

        return redirect()->route('books.show', $book);
    }

    public function store(Book $book)
    {
        $book->copies()->create([
            'reference' => $book->isbn . '_' . $book->copies()->count(),
        ]);

        return redirect()->route('books.show', $book);
    }
}
