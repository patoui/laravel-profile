<?php

declare(strict_types=1);

use App\User;

if (! function_exists('me')) {

    /** @return mixed */
    function me()
    {
        return User::where('email', 'patrique.ouimet@gmail.com')->first();
    }

}
