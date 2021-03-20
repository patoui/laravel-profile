<?php

declare(strict_types=1);

namespace App;

use Database\Factories\UserFactory;
use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use RuntimeException;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * Class User
 * @package App
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $provider
 * @property int $provider_id
 * @property string $password
 * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $email_verified_at
 *
 * @property-read bool $is_admin
 *
 * @method static UserFactory factory(...$parameters)
 */
class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use Notifiable;
    use InteractsWithMedia;
    use HasFactory;

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

    public function favourites(): HasMany
    {
        return $this->hasMany(Favourite::class);
    }

    /**
     * @param Comment|Post|Tip $model
     * @throws Exception
     */
    public function toggleFavourite($model): void
    {
        // Verify argument is an object
        if (!is_object($model)) {
            throw new RuntimeException('Model must be passed');
        }

        // Get model class name
        $class = get_class($model);

        if (!in_array($class, [Comment::class, Post::class, Tip::class, Video::class], true)) {
            throw new RuntimeException(
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
            'favouritable_id'   => $model->id,
            'favouritable_type' => $class,
        ]);
    }

    public function getIsAdminAttribute(): bool
    {
        return in_array($this->email, [
            'patrique.ouimet@gmail.com',
            'taylorjdunphy@gmail.com',
        ]);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    public function getRouteKeyName(): string
    {
        return 'email';
    }
}
