<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use Notifiable, HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'provider', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be appended to arrays.
     *
     * @var array
     */
    protected $appends = ['is_admin'];

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

    public function toggleFavourite($model)
    {
        // Verify argument is an object
        if (! is_object($model)) {
            throw new \Exception('Model must be passed');
        }

        // Get model class name
        $class = get_class($model);

        if (! in_array($class, ['App\Comment', 'App\Post', 'App\Tip'])) {
            throw new \Exception(
                "Model class must be 'App\Comment', 'App\Post' or 'App\Tip'"
            );
        }

        $favourite = $this->favourites()
            ->where('favouritable_id', $model->id)
            ->where('favouritable_type', $class)
            ->first();

        if ($favourite) {
            return $favourite->delete();
        } else {
            return $this->favourites()->create([
                'favouritable_id' => $model->id,
                'favouritable_type' => $class,
            ]);
        }
    }

    public function getIsAdminAttribute()
    {
        return (bool) in_array($this->email, [
            'patrique.ouimet@gmail.com',
            'taylorjdunphy@gmail.com',
        ]);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function getRouteKeyName()
    {
        return 'email';
    }
}
