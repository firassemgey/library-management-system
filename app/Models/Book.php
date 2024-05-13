<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Book extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
    ];

    public function authors() {
        return $this->belongsToMany(Author::class);

    }

    public function comments():MorphMany
    {
        return $this->morphMany(Comment::class,'commentable');
    }
}
