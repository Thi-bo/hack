<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
{
    public function definition()
    {
        return [
            'id' => 'PRF' .Str::random(5),
            'score' => $this->faker->numberBetween(0, 5000),
            'totlesub' => $this->faker->numberBetween(0, 100),
            'last_sub_time' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => function (array $attributes) {
                return $attributes['created_at'];
            },
        ];
    }

    // État pour un profil de débutant
    public function beginner()
    {
        return $this->state(function (array $attributes) {
            return [
                'score' => $this->faker->numberBetween(0, 1000),
                'totlesub' => $this->faker->numberBetween(0, 20),
            ];
        });
    }

    // État pour un profil avancé
    public function advanced()
    {
        return $this->state(function (array $attributes) {
            return [
                'score' => $this->faker->numberBetween(3000, 5000),
                'totlesub' => $this->faker->numberBetween(50, 100),
            ];
        });
    }
}
