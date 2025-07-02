@extends('layouts.app')

@section('content')
    <h1>Edit Author</h1>
    <form action="{{ route('authors.update', $author->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Author Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $author->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update Author</button>
    </form>
    <a href="{{ route('authors.index') }}" class="btn btn-secondary mt-3">Back to Authors</a>
@endsection