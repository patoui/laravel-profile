<?php

declare(strict_types=1);

namespace App;

use Database\Factories\FavouriteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Class Favourite
 * @package App
 *
 * @method static FavouriteFactory factory(...$parameters)
 */
class Favourite extends Model
{
    use HasFactory;

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
