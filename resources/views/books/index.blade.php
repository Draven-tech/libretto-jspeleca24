@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Books</h1>
        <a href="{{ route('books.create') }}" class="btn btn-primary">Add New Book</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @foreach($books as $book)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">by {{ $book->author->name }}</h6>
                            </div>
                                <div class="card-actions float-end">
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </div>
                        
                        <p class="card-text mt-2">
                            @foreach($book->genres as $genre)
                                <span class="badge bg-secondary">{{ $genre->name }}</span>
                            @endforeach
                        </p>
                        
                        <p class="card-text">
                            Average Rating: 
                            @if($book->reviews->count() > 0)
                                {{ number_format($book->reviews->avg('rating'), 1) }}/5
                                ({{ $book->reviews->count() }} reviews)
                            @else
                                No reviews yet
                            @endif
                        </p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-primary">
                                View Details
                            </a>
                            <a href="{{ route('reviews.create.for.book', $book->id) }}" class="btn btn-sm btn-success">
                                Add Review
                            </a>
                            
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-4">
                            {{ $books->links() }}
        </div>
@endsection