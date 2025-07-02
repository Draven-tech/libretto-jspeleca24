@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Genre Details: {{ $genre->name }}</span>
                        <div class="btn-group">
                            <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this genre?')">Delete</button>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="mb-4">
                            <h5>Books in this Genre ({{ $genre->books->count() }})</h5>
                            
                            @if($genre->books->count() > 0)
                                <div class="list-group">
                                    @foreach($genre->books as $book)
                                        <a href="{{ route('books.show', $book->id) }}" class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">{{ $book->title }}</h6>
                                                <small>Rating: 
                                                    @if($book->reviews->count() > 0)
                                                        {{ number_format($book->reviews->avg('rating'), 1) }}/5
                                                    @else
                                                        Not rated
                                                    @endif
                                                </small>
                                            </div>
                                            <p class="mb-1">by {{ $book->author->name }}</p>
                                            <small class="text-muted">
                                                {{ $book->reviews->count() }} {{ Str::plural('review', $book->reviews->count()) }}
                                            </small>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">No books in this genre yet.</p>
                            @endif
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('genres.index') }}" class="btn btn-secondary">Back to Genres</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection