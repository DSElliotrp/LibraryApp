<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;


class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function copies()
    {
        return $this->hasMany(BookCopy::class);
    }
    
    public function availableCopies(): Collection
    {
        return $this->copies->filter(fn($copy) => !$copy->isBorrowed());
    }

    // public function borrow()
    // {
    //     $availableCopy = $this->copies->first(fn($copy) => !$copy->isBorrowed());

    //     if ($availableCopy) {
    //         $availableCopy->borrow();
    //     }
    // }
}