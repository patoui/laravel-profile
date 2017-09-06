<?php

namespace App;

use App\Favourite;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
    protected $hidden = [
        'password', 'remember_token',
    ];

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

        if (! in_array($class, ['App\Comment'])) {
            throw new \Exception('Model class must be \'App\Comment\'');
        }

        $favourite = $this->favourites()
            ->where('favouritable_id', $model->id)
            ->where('favouritable_type', $class)
            ->first();

        if (! $favourite) {
            // Create favourite
            return $this->favourites()->create([
                'favouritable_id' => $model->id,
                'favouritable_type' => $class,
            ]);
        }

        return null;
    }

    public function isAdmin()
    {
        return 'patrique.ouimet@gmail.com' == $this->email;
    }
}
