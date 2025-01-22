<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCopy;
use App\Models\Borrowing;
use App\Models\User;

class BorrowingController extends Controller
{
    public function create(Book $book, BookCopy $copy)
    {
        return view('borrowings.create', [
            'book' => $book,
            'copy' => $copy,
        ]);
    }

    public function store(Book $book, BookCopy $copy)
    {
        $user = User::where(['email' => request()->customer_email])->firstOrFail();

        Borrowing::create([
            'book_copy_id' => $copy->id,
            'borrowed_at' => now(),
            'due_at' => now()->addDays(28),
            'user_id' => $user->id,
        ]);

        return view('books.show', [
            'book' => $book,
        ]);
    }

    public function update(Book $book, BookCopy $copy, Borrowing $borrowing)
    {
        $borrowing->update([
            'returned_at' => now(),
        ]);

        return view('books.show', [
            'book' => $book,
        ]);
    }
}
