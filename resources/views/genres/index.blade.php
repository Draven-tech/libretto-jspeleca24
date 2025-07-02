@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Genres</h1>
        <a href="{{ route('genres.create') }}" class="btn btn-primary">Add New Genre</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @foreach($genres as $genre)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">{{ $genre->name }}</h5>
                            <div class="card-actions float-end">
                            <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                        </div>
                        
                        <h6 class="card-subtitle mb-2 text-muted mt-2">
                            {{ $genre->books->count() }} {{ Str::plural('book', $genre->books->count()) }}
                        </h6>
                        
                        @if($genre->books->count() > 0)
                            <div class="mt-3">
                                <h6>Books in this genre:</h6>
                                <ul class="list-group list-group-flush">
                                    @foreach($genre->books->take(3) as $book)
                                        <li class="list-group-item p-2">
                                            <a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a>
                                            <small class="text-muted">by {{ $book->author->name }}</small>
                                        </li>
                                    @endforeach
                                    @if($genre->books->count() > 3)
                                        <li class="list-group-item p-2 text-center">
                                            + {{ $genre->books->count() - 3 }} more...
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        @else
                            <p class="text-muted mt-2">No books in this genre yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection