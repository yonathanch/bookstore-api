<?php

namespace App\Http\Controllers\api;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    public function topAuthors()
    {
        set_time_limit(300); 
        $authors = Author::withCount(['ratings as voter_count' => function ($query) {
                $query->where('rating', '>', 5);
            }])
            ->whereHas('ratings', function ($query) {
                $query->where('rating', '>', 5);
            })
            ->having('voter_count', '>', 0)
            ->orderBy('voter_count', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($author, $index) {
                $author->rank = $index + 1;
                return $author;
            });

        return response()->json(['data' => $authors]);
    }
}
