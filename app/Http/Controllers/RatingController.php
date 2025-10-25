<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;

class RatingController extends Controller
{
     public function create(Request $request)
    {
        $authors = Author::orderBy('name')->get(['id', 'name']);
        
        if ($request->has('author_id')) {
            $selectedAuthorId = $request->author_id;
            $authorBooks = \App\Models\Book::where('author_id', $selectedAuthorId)->get();
            
            return view('ratingsCreate', compact('authors', 'selectedAuthorId', 'authorBooks'));
        }

        return view('ratingsCreate', compact('authors'));
    }

      public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => ['required', 'integer', Rule::in(range(1, 10))],
        ]);

        Rating::create($validated);

        return redirect()->route('booksIndex')
            ->with('success', 'Rating submitted successfully!');
    }
}
