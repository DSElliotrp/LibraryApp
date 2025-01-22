<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCopy extends Model
{
    /** @use HasFactory<\Database\Factories\BookCopyFactory> */
    use HasFactory;

    protected $guarded = [];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function isBorrowed(): bool
    {
        return $this->borrowings()->whereNull('returned_at')->exists();
    }

    public function activeBorrowing(): Borrowing
    {
        return $this->borrowings()->whereNull('returned_at')->first();
    }
}
