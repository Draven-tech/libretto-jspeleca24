@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Authors</h1>
        <a href="{{ route('authors.create') }}" class="btn btn-primary">Add New Author</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        @foreach($authors as $author)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $author->name }}</h5>
                        <div class="card-actions float-end">
                            <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                        <h6 class="card-subtitle mb-2 text-muted">Books: {{ $author->books->count() }}</h6>
                        <ul class="list-group list-group-flush">
                            @foreach($author->books as $book)
                                <li class="list-group-item">
                                    <a href="/books/{{ $book->id }}">{{ $book->title }}</a>
                                </li>
                            @endforeach
                        </ul>
    
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection