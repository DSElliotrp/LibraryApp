<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Book;

Route::middleware('auth')->group(function () {
    Route::get('/', fn() => view('home', ['books' => Book::all()]))->name('home');

    Route::get('/books', fn() => view('books', ['books' => Book::with(['author', 'genres', 'copies.borrowings'])->paginate(5)]))->name('books');

    Route::get('/book/{id}', fn($id) => view('book', ['book' => Book::find($id)]));
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
