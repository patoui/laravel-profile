<?php

declare(strict_types=1);

namespace Database\Factories;

use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        static $password;
        return [
            'name'           => $this->faker->name,
            'email'          => $this->faker->unique()->safeEmail,
            'password'       => $password ?: $password = bcrypt('secret'),
            'remember_token' => uniqid('', true),
        ];
    }

    public function me(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return ['email' => 'patrique.ouimet@gmail.com'];
        });
    }

    public function admin(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return ['email' => 'patrique.ouimet@gmail.com'];
        });
    }
}
