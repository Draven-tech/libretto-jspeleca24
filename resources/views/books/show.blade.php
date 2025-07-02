@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>{{ $book->title }}</h1>
            <p class="lead">by <a href="{{ route('authors.index') }}">{{ $book->author->name }}</a></p>
            
            <div class="mb-4">
                <h4>Genres</h4>
                @foreach($book->genres as $genre)
                    <span class="badge bg-primary">{{ $genre->name }}</span>
                @endforeach
            </div>

            <div class="mb-4 d-flex justify-content-between align-items-center">
                <h4>Reviews</h4>
                <a href="{{ route('reviews.create.for.book', $book->id) }}" class="btn btn-success">Add Review</a>
            </div>

            @if($book->reviews->count() > 0)
                <div class="list-group">
                    @foreach($book->reviews as $review)
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Rating: {{ $review->rating }}/5</h5>
                                <div class="btn-group">
                                    <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                            <p class="mb-1">{{ $review->content }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No reviews yet for this book.</p>
            @endif
        </div>
    </div>
    <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">Back to Books</a>
@endsection