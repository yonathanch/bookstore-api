<?php

namespace App\Http\Controllers\api;

use App\Models\Book;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class RatingController extends Controller
{
     public function store(Request $request)
    {
        set_time_limit(300); 
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => ['required', 'integer', Rule::in(range(1, 10))],
        ]);

        $rating = Rating::create($validated);

        return response()->json([
            'message' => 'Rating submitted successfully',
            'data' => $rating 
        ], 201);
    }

    public function getBooksByAuthor($authorId)
    {
        set_time_limit(300); 
        $books = Book::where('author_id', $authorId)
            ->with(['categories', 'author'])
            ->withCount('ratings as voter_count')
            ->withAvg('ratings as average_rating', 'rating')
            ->orderBy('average_rating', 'desc')
            ->get();

        return response()->json(['data' => $books]);
    }
}
