<?php

use App\User;

if (! function_exists('me')) {
    /**
     * @return App\User my user instance
     */
    function me()
    {
        return User::where('email', 'patrique.ouimet@gmail.com')->first();
    }
}
