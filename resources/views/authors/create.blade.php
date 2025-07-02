@extends('layouts.app')

@section('content')
    <h1>Create New Author</h1>
    <form action="{{ route('authors.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Author Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Create Author</button>
    </form>
    <a href="{{ route('authors.index') }}" class="btn btn-secondary mt-3">Back to Authors</a>
@endsection