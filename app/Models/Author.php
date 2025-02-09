<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Author extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        ];

    public function books() {
        return $this->belongsToMany(Book::class);

    }

    public function comments():MorphMany
    {
        return $this->morphMany(Comment::class,'commentable');
    }
}
