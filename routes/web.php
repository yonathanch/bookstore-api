<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\RatingController;

// Book Routes
Route::get('/', [BookController::class, 'index'])->name('index');
Route::get('/books', [BookController::class, 'index'])->name('index');

// Author Routes  
Route::get('/authors/top', [AuthorController::class, 'topAuthors'])->name('authorsTop');
// Route::get('/authors/{authorId}/books', [AuthorController::class, 'authorBooks'])->name('authors.books');

// Rating Routes
Route::get('/ratings/create', [RatingController::class, 'create'])->name('ratingsCreate');
Route::post('/ratings', [RatingController::class, 'store'])->name('ratingsStore');