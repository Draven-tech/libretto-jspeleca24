<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['author', 'genres', 'reviews'])->paginate(15);
        
        if (request()->wantsJson()) {
            return response()->json($books);
        }
        
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::all();
        $genres = Genre::all();
        
        return view('books.create', compact('authors', 'genres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'genres' => 'array',
            'genres.*' => 'exists:genres,id',
        ]);

        $book = Book::create($validated);
        
        if ($request->has('genres')) {
            $book->genres()->attach($request->genres);
        }

        if ($request->wantsJson()) {
            return response()->json($book->load(['author', 'genres']), 201);
        }

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function show(Book $book)
    {
        $book->load(['author', 'genres', 'reviews']);
        
        if (request()->wantsJson()) {
            return response()->json($book);
        }
        
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $authors = Author::all();
        $genres = Genre::all();
        
        return view('books.edit', compact('book', 'authors', 'genres'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'genres' => 'array',
            'genres.*' => 'exists:genres,id',
        ]);

        $book->update($validated);
        
        if ($request->has('genres')) {
            $book->genres()->sync($request->genres);
        }

        if ($request->wantsJson()) {
            return response()->json($book->load(['author', 'genres']));
        }

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        if (request()->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }

    public function getBookReviews(Book $book)
    {
        $reviews = $book->reviews()->paginate(10);
        
        return response()->json($reviews);
    }
}