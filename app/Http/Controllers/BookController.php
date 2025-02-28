<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Genre;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index()
    {
        return view(
            'books.index',
            ['books' =>
                Book::query()
                ->with(['genres', 'copies.borrowings'])
                ->where([['title', 'like', '%' . request('query') . '%']])
                ->orWhere([['author', 'like', '%' . request('query') . '%']])
                ->orWhereHas('genres', function ($genres) {
                    $genres->where('name', 'like', '%' . request('query') . '%');
                })
                ->latest()
                ->paginate(5)]);
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
            'genres' => 'required',
            'photo' => 'required|image',
        ]);

        DB::beginTransaction();

        try {
            $photoPath = request('photo')->store('photos', 'public');

            $book = Book::create([
                'title' => request('title'),
                'author' => request('author'),
                'description' => request('description'),
                'published_at' => request('published_at'),
                'isbn' => request('isbn'),
                'created_by_user_id' => Auth::id(),
                'photo_path' => $photoPath,
            ]);
    
            foreach (explode(',', request('genres')) as $genreName) {
                $genre = Genre::firstOrCreate(['name' => Str::title(trim($genreName))]);
                $book->genres()->attach($genre);
            }
    
            foreach (range(1, request('number_of_copies')) as $i) {
                $book->copies()->create([
                    'reference' => $book->isbn . '_' . $i,
                ]);
            }

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return redirect('/books');
    }

    public function show(Book $book)
    {
        return view('books.show', ['book' => $book]);
    }

    public function edit(Book $book)
    {
        return view('books.edit', ['book' => $book]);
    }

    public function update(Book $book)
    {
        request()->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'published_at' => 'date',
            'isbn' => 'required|digits:13',
            'genres' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $book->update([
                'title' => request('title'),
                'author' => request('author'),
                'description' => request('description'),
                'published_at' => request('published_at'),
                'isbn' => request('isbn'),
            ]);
    
            $genres = collect(explode(',', request('genres')))->map(function ($genreName) { 
                return Genre::firstOrCreate(['name' => Str::title(trim($genreName))]);
            });
    
            $book->genres()->sync($genres);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return redirect('/books/' . $book->id);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect('/books');
    }
}
