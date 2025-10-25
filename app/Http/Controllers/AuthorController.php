<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
                return [
                    'id' => $author->id,
                    'name' => $author->name,
                    'voter_count' => $author->voter_count,
                    'rank' => $index + 1
                ];
            });

        return view('authorsTop', ['authors' => $authors]);
    }
}
