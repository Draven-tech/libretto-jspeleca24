@extends('layouts.app')

@section('content')
    <h1>Edit Book</h1>
    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Book Title</label>
            <input type="text" class="form-control" id="title" name="title" 
                   value="{{ $book->title }}" required>
        </div>
        <div class="form-group mt-3">
            <label for="author_id">Author</label>
            <select class="form-control" id="author_id" name="author_id" required>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ $book->author_id == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group mt-3">
            <label>Genres</label>
            <div class="row">
                @foreach($genres as $genre)
                    <div class="col-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="genres[]" 
                                   value="{{ $genre->id }}" id="genre_{{ $genre->id }}"
                                   {{ $book->genres->contains($genre->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="genre_{{ $genre->id }}">
                                {{ $genre->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update Book</button>
    </form>
    <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">Back to Books</a>
@endsection