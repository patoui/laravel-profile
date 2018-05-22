<?php

use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->state(App\User::class, 'me', [
    'email' => 'patrique.ouimet@gmail.com',
]);

$factory->state(App\User::class, 'admin', [
    'email' => 'patrique.ouimet@gmail.com'
]);

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->name,
        'body' => $faker->text(),
        'slug' => $faker->slug,
    ];
});

$factory->state(App\Post::class, 'published', function (Faker\Generator $faker) {
    return [
        'published_at' => Carbon::now()->subDay()->format('Y-m-d H:i:s'),
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'body' => $faker->text(),
    ];
});
