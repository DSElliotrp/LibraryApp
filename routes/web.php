<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Book;

Route::middleware('auth')->group(function () {
    Route::get('/', fn() => view('home'))->name('home');

    Route::get('/books', fn() => view('books.index', ['books' => Book::with(['genres', 'copies.borrowings'])->latest()->paginate(5)]))->name('books');
    
    Route::get('/books/create', fn() => view('books.create'));
    
    Route::get('/books/{id}', fn($id) => view('books.show', ['book' => Book::find($id)]));

    Route::patch('/books/{id}', function($id) {
        request()->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'published_at' => 'date',
            'isbn' => 'required|digits:13',
            'number_of_copies' => 'required|integer|min:1',
        ]);

        $book = Book::findOrFail($id);

        $book->update([
            'title' => request('title'),
            'author' => request('author'),
            'description' => request('description'),
            'published_at' => request('published_at'),
            'isbn' => request('isbn'),
        ]);

        return redirect('/books/' . $book->id);
    });
    
    Route::delete('/books/{id}', function($id) {
        Book::with('copies.borrowings')->findOrFail($id)->delete();

        return redirect('/books');
    });

    Route::get('/books/{id}/edit', fn($id) => view('books.edit', ['book' => Book::find($id)]));

    Route::post('/books', function () {
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

        return redirect()->route('books');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
