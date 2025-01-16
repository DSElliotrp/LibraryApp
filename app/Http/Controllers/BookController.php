<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book; // Add this line to import the Book model

class BookController extends Controller
{
    public function index()
    {
        return view(
            'books.index',
            ['books' =>
                Book::with(['genres', 'copies.borrowings'])->latest()->paginate(5)]);
    }

    public function create()
    {
        return view('books.create');
    }

    public function store()
    {
        request()->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'published_at' => 'date',
            'isbn' => 'required|digits:13',
            'number_of_copies' => 'required|integer|min:1',
        ]);

        $book = Book::create([
            'title' => request('title'),
            'author' => request('author'),
            'description' => request('description'),
            'published_at' => request('published_at'),
            'isbn' => request('isbn'),
            'created_by_user_id' => 1,
        ]);

        // foreach (request('genres') as $genreId) {
        //     $book->genres()->attach($genreId);
        // }

        foreach (range(1, request('number_of_copies')) as $i) {
            $book->copies()->create([
                'reference' => $book->isbn . '-' . $i,
            ]);
        }

        return redirect('/books');
    }

    public function show($book)
    {
        return view('books.show', ['book' => $book]);
    }

    public function edit($book)
    {
        return view('books.edit', ['book' => $book]);
    }

    public function update($book)
    {
        request()->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'published_at' => 'date',
            'isbn' => 'required|digits:13',
            'number_of_copies' => 'required|integer|min:1',
        ]);

        $book->update([
            'title' => request('title'),
            'author' => request('author'),
            'description' => request('description'),
            'published_at' => request('published_at'),
            'isbn' => request('isbn'),
        ]);

        return redirect('/books/' . $book->id);
    }

    public function destroy($book)
    {
        $book->delete();

        return redirect('/books');
    }
}
