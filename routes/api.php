<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\BookController;
use App\Http\Controllers\api\AuthorController;
use App\Http\Controllers\api\RatingController;

Route::get('/books', [BookController::class, 'index'])->name('book');
Route::get('/authors/top',[AuthorController::class, 'topAuthors']);

Route::post('/ratings', [RatingController::class, 'store']);
Route::get('/authors/{authorId}/books', [RatingController::class, 'getBooksByAuthor']);





