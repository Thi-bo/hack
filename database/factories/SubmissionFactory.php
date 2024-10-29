<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Submission>
 */
class SubmissionFactory extends Factory
{
    public function definition()
    {
        $solved = $this->faker->boolean(40);  // 40% de chance d'avoir résolu
        $hinted = $this->faker->boolean(30);  // 30% de chance d'avoir utilisé un indice

        return [
            'id' => 'SUB' . Str::random(5),
            'curr_score' => function (array $attributes) use ($solved) {
                // On récupérera les points de la question dans le seeder si solved
                return $solved ? null : 0;
            },
            'sub_time' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
            'hinted' => $hinted,
            'solved' => $solved,
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => function (array $attributes) {
                return $attributes['created_at'];
            },
        ];
    }

    // État pour une soumission réussie
    public function solved()
    {
        return $this->state(function (array $attributes) {
            return [
                'solved' => true,
                'hinted' => $this->faker->boolean(30),
            ];
        });
    }

    // État pour une soumission avec indice
    public function hinted()
    {
        return $this->state(function (array $attributes) {
            return [
                'hinted' => true,
                'solved' => $this->faker->boolean(60),  // 60% de chance de résolution avec indice
            ];
        });
    }
}

