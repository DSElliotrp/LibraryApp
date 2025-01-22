<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', fn() => view('home'))->name('home');
    Route::resource('books', BookController::class);
    Route::get('/books/{book}/copies/{copy}/borrowing/create', [BorrowingController::class, 'create']);
    Route::post('/books/{book}/copies/{copy}/borrowing', [BorrowingController::class, 'store']);
    Route::post('/books/{book}/copies/{copy}/borrowing/{borrowing}/edit', [BorrowingController::class, 'update']);
    Route::delete('/books/{book}/copies/{copy}', [CopyController::class, 'destroy']);
    Route::post('/books/{book}/copies', [CopyController::class, 'store']);
    Route::get('/my-books', [BorrowingController::class, 'index'])->name('my-books');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
