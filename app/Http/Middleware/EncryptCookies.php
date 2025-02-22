<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as BaseEncrypter;

final class EncryptCookies extends BaseEncrypter
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array<int, string>
     */
    protected $except = [];
}
