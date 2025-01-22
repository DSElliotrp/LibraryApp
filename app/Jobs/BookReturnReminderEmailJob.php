<?php

namespace App\Jobs;

use App\Mail\BookReturnReminder;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class BookReturnReminderEmailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Book $book, public Borrowing $borrowing, public User $user)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->borrowing->returned_at !== null) {
            return;
        }
        
        Mail::to($this->user)->send(new BookReturnReminder($this->book, $this->user));
    }
}
