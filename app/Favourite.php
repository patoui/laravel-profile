<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Favourite extends Model
{
    /** @var array<string> */
    protected $fillable = [
        'favouritable_id',
        'favouritable_type',
        'user_id',
    ];

    public function comments() : MorphToMany
    {
        return $this->morphedByMany(Comment::class, 'favouritable');
    }
}
