<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use App\Video;

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
