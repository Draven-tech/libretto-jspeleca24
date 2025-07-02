@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <h1 class="display-4">Welcome to Libretto</h1>
        <p class="lead">A book review system built with Laravel</p>
        <hr class="my-4">
        <p>Explore our collection of books, authors, and genres.</p>
        <a class="btn btn-primary btn-lg" href="/books" role="button">Browse Books</a>
    </div>
@endsection