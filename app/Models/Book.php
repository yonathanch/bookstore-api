<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'author_id'];
    
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

  
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(BookCategory::class, 'book_category');
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }
}
