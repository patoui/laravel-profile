<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->state(User::class, 'me', [
    'email' => 'patrique.ouimet@gmail.com',
]);

$factory->state(User::class, 'admin', [
    'email' => 'patrique.ouimet@gmail.com'
]);
