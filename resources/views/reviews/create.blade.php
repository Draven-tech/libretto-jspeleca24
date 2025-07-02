@extends('layouts.app')

@section('content')
    <h1>Add Review for {{ $book->title }}</h1>
    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        <input type="hidden" name="book_id" value="{{ $book->id }}">
        <div class="form-group">
            <label for="content">Review Content</label>
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
        </div>
        <div class="form-group mt-3">
            <label for="rating">Rating (1-5)</label>
            <select class="form-control" id="rating" name="rating" required>
                <option value="1">1 - Poor</option>
                <option value="2">2 - Fair</option>
                <option value="3">3 - Good</option>
                <option value="4">4 - Very Good</option>
                <option value="5">5 - Excellent</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit Review</button>
    </form>
    <a href="{{ route('books.show', $book->id) }}" class="btn btn-secondary mt-3">Back to Book</a>
@endsection