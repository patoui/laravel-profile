<?php

declare(strict_types=1);

namespace App;

use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use Notifiable;
    use HasMediaTrait;

    /** @var array<string> */
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'provider_id',
    ];

    /** @var array<string> */
    protected $hidden = ['password', 'remember_token'];

    /** @var array<string> */
    protected $appends = ['is_admin'];

    public function favourites() : HasMany
    {
        return $this->hasMany(Favourite::class);
    }

    /**
     * @param Comment|Post|Tip $model
     * @throws Exception
     */
    public function toggleFavourite($model) : void
    {
        // Verify argument is an object
        if (! is_object($model)) {
            throw new Exception('Model must be passed');
        }

        // Get model class name
        $class = get_class($model);

        if (! in_array($class, ['App\Comment', 'App\Post', 'App\Tip', 'App\Video'])) {
            throw new Exception(
                "Model class must be 'App\Comment', 'App\Post', 'App\Tip' or 'App\Video'"
            );
        }

        $favourite = $this->favourites()
            ->getQuery()
            ->where('favouritable_id', $model->id)
            ->where('favouritable_type', $class)
            ->first();

        if ($favourite) {
            $favourite->delete();

            return;
        }

        $this->favourites()->create([
            'favouritable_id' => $model->id,
            'favouritable_type' => $class,
        ]);
    }

    public function getIsAdminAttribute() : bool
    {
        return (bool) in_array($this->email, [
            'patrique.ouimet@gmail.com',
            'taylorjdunphy@gmail.com',
        ]);
    }

    public function activities() : HasMany
    {
        return $this->hasMany(Activity::class);
    }

    public function getRouteKeyName() : string
    {
        return 'email';
    }
}
