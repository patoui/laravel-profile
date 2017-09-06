<?php

namespace App;

use App\Comment;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $fillable = [
        'favouritable_id',
        'favouritable_type',
        'user_id'
    ];

    /**
     * Get all of the posts that are assigned this favourite.
     */
    public function comments()
    {
        return $this->morphedByMany(Comment::class, 'favouritable');
    }
}
