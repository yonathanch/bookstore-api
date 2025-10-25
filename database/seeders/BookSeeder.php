<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Author;
use App\Models\BookCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = Author::all();
        $categories = BookCategory::all();
        $chunkSize = 10000;
        $totalBooks = 100000;

        for ($i = 0; $i < $totalBooks; $i += $chunkSize) {
            $booksData = [];
            $pivotData = [];
            
            $currentChunkSize = min($chunkSize, $totalBooks - $i);
            
            for ($j = 0; $j < $currentChunkSize; $j++) {
                $bookId = $i + $j + 1;
                
                $booksData[] = [
                    'id' => $bookId,
                    'name' => fake()->sentence(rand(2, 5)),
                    'author_id' => $authors->random()->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $randomCategoryIds = $categories->random(rand(1, 3))->pluck('id');
                foreach ($randomCategoryIds as $categoryId) {
                    $pivotData[] = [
                        'book_id' => $bookId,
                        'book_category_id' => $categoryId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
            
            DB::table('books')->insert($booksData);
            
            $pivotChunks = array_chunk($pivotData, 5000);
            foreach ($pivotChunks as $chunk) {
                DB::table('book_category')->insert($chunk);
        }    
    }
}
}
