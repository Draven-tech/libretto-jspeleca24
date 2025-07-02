<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Book;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
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

        Review::create($validated);

        return redirect()->route('books.show', $request->book_id)
                         ->with('success', 'Review added successfully.');
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

        return redirect()->route('books.show', $review->book_id)
                         ->with('success', 'Review updated successfully.');
    }

    public function destroy(Review $review)
    {
        $book_id = $review->book_id;
        $review->delete();

        return redirect()->route('books.show', $book_id)
                         ->with('success', 'Review deleted successfully.');
    }
}