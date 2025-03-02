<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

final class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->name,
            'body' => $this->faker->text(),
            'slug' => $this->faker->slug,
        ];
    }

    public function published(): PostFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'published_at' => Carbon::now()->subDay()->format('Y-m-d H:i:s'),
            ];
        });
    }
}
