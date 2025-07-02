@extends('layouts.app')

@section('content')
    <h1>Edit Review for {{ $review->book->title }}</h1>
    <form action="{{ route('reviews.update', $review->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="content">Review Content</label>
            <textarea class="form-control" id="content" name="content" rows="5" required>{{ $review->content }}</textarea>
        </div>
        <div class="form-group mt-3">
            <label for="rating">Rating (1-5)</label>
            <select class="form-control" id="rating" name="rating" required>
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>
                        {{ $i }} - {{ $i == 1 ? 'Poor' : ($i == 2 ? 'Fair' : ($i == 3 ? 'Good' : ($i == 4 ? 'Very Good' : 'Excellent'))) }}
                    </option>
                @endfor
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update Review</button>
    </form>
    <a href="{{ route('books.show', $review->book_id) }}" class="btn btn-secondary mt-3">Back to Book</a>
@endsection