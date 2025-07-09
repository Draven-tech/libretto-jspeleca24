<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Book;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('book')->paginate(10);
        
        if (request()->wantsJson()) {
            return response()->json($reviews);
        }
        
        // Web view would need to be implemented if needed
        abort(404);
    }

    public function createForBook(Book $book)
    {
        return view('reviews.create', compact('book'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'content' => 'required|string',
            'rating' => 'required|integer|between:1,5',
        ]);

        $review = Review::create($validated);

        if ($request->wantsJson()) {
            return response()->json($review, 201);
        }

        return redirect()->route('books.show', $request->book_id)
                         ->with('success', 'Review added successfully.');
    }

    public function show(Review $review)
    {
        $review->load('book');
        
        if (request()->wantsJson()) {
            return response()->json($review);
        }
        
        // Web view would need to be implemented if needed
        abort(404);
    }

    public function edit(Review $review)
    {
        return view('reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'rating' => 'required|integer|between:1,5',
        ]);

        $review->update($validated);

        if ($request->wantsJson()) {
            return response()->json($review);
        }

        return redirect()->route('books.show', $review->book_id)
                         ->with('success', 'Review updated successfully.');
    }

    public function destroy(Review $review)
    {
        $book_id = $review->book_id;
        $review->delete();

        if (request()->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('books.show', $book_id)
                         ->with('success', 'Review deleted successfully.');
    }
}