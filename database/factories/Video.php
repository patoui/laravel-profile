<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Video;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Video::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'slug' => $faker->slug,
        'external_id' => $faker->uuid,
    ];
});

$factory->state(Video::class, 'published', function () {
    return [
        'published_at' => Carbon::now()->subDay()->format('Y-m-d H:i:s'),
    ];
});
