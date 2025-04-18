<?php

declare(strict_types=1);

namespace App;

use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * Class User
 *
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
 * @property-read bool $is_admin
 *
 * @method static UserFactory factory(...$parameters)
 */
final class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;

    /** @var list<string> */
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'provider_id',
    ];

    /** @var list<string> */
    protected $hidden = ['password', 'remember_token'];

    /** @var list<string> */
    protected $appends = ['is_admin'];

    public function getRouteKeyName(): string
    {
        return 'email';
    }

    protected function isAdmin(): Attribute
    {
        return Attribute::make(get: function () {
            return in_array($this->email, [
                'patrique.ouimet@gmail.com',
            ]);
        });
    }
}
