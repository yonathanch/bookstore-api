<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\RatingController;


Route::get('/', [AuthorController::class, 'topAuthors'])->name('authorsTop');
Route::get('/books', [BookController::class, 'index'])->name('booksIndex');

// Author Routes  
Route::get('/authors/top', [AuthorController::class, 'topAuthors'])->name('authorsTop');

// Rating Routes
Route::get('/ratings/create', [RatingController::class, 'create'])->name('ratingsCreate');
Route::post('/ratings', [RatingController::class, 'store'])->name('ratingsStore');