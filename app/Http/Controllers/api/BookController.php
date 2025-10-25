<?php

namespace App\Http\Controllers\api;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index(Request $request)
    {
        set_time_limit(300); 
        $perPage = min($request->get('per_page', 10), 100);
        $search = $request->get('search');

        $query = Book::with(['author', 'categories'])
            ->withCount('ratings as voter_count')
            ->withAvg('ratings as average_rating', 'rating')
            ->orderBy('average_rating', 'desc')
            ->orderBy('voter_count', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('author', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('categories', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $books = $query->paginate($perPage);

         return response()->json(['data' => $books]);
    }


}
