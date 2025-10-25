<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Rating;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $totalRatings = 500000;
        $chunkSize = 10000;

        $bookIds = Book::pluck('id')->toArray();

        for ($i = 0; $i < $totalRatings; $i += $chunkSize) {
            $ratings = [];
            
            $currentChunkSize = min($chunkSize, $totalRatings - $i);
            
            for ($j = 0; $j < $currentChunkSize; $j++) {
                $ratings[] = [
                    'book_id' => $bookIds[array_rand($bookIds)],
                    'rating' => rand(1, 10),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            
            DB::table('ratings')->insert($ratings);
        }
    }
}
