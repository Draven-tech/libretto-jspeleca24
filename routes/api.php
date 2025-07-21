<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ReviewController;
use App\Http\Middleware\CheckTokenExpiration;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', CheckTokenExpiration::class])->group(function () {
    Route::apiResource('authors', AuthorController::class);
    Route::apiResource('books', BookController::class);
    Route::apiResource('genres', GenreController::class);
    Route::apiResource('reviews', ReviewController::class);
    
    Route::get('/books/{book}/reviews', [BookController::class, 'getBookReviews']);
    Route::get('/reviews/books/{book}', [ReviewController::class, 'getReviewsByBook']);
});