<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Video;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

final class VideoFactory extends Factory
{
    protected $model = Video::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->name,
            'slug' => $this->faker->slug,
            'external_id' => $this->faker->uuid,
        ];
    }

    public function published(): VideoFactory
    {
        return $this->state(function (array $attributes) {
            return ['published_at' => Carbon::now()->subDay()->format('Y-m-d H:i:s')];
        });
    }
}
