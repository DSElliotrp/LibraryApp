<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\BookReturnReminderEmailJob;
use App\Mail\BookBorrowed;
use App\Models\Book;
use App\Models\BookCopy;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

        $borrowing = Borrowing::create([
            'book_copy_id' => $copy->id,
            'borrowed_at' => now(),
            'due_at' => now()->addDays(28),
            'user_id' => $user->id,
        ]);

        Mail::to($user)->queue(new BookBorrowed($book, $borrowing, $user));
        BookReturnReminderEmailJob::dispatch($book, $borrowing, $user)->delay($borrowing->due_at->subDay());

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

    public function index()
    {
        return view('borrowings.index', [
            'borrowings' => Borrowing::with('bookCopy.book')->where('user_id', Auth::id())->get(),
        ]);
    }
}
