<?php

use App\Post;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'body' => $faker->text(),
        'slug' => $faker->slug,
    ];
});

$factory->state(Post::class, 'published', function (Faker $faker) {
    return [
        'published_at' => Carbon::now()->subDay()->format('Y-m-d H:i:s'),
    ];
});
