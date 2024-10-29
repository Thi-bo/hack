<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Questions>
 */
class QuestionFactory extends Factory
{
    public function definition()
    {
        $categories = ['Web', 'Crypto', 'Forensics', 'Pwn', 'Reverse', 'OSINT', 'Steganography', 'Misc'];
        $levels = ['Easy', 'Medium', 'Hard', 'Expert'];
        $category = $this->faker->randomElement($categories);
        $level = $this->faker->randomElement($levels);

        // Points basés sur le niveau
        $points = match($level) {
            'Easy' => $this->faker->randomElement([100, 200]),
            'Medium' => $this->faker->randomElement([300, 400]),
            'Hard' => $this->faker->randomElement([500, 600]),
            'Expert' => $this->faker->randomElement([700, 800, 1000]),
            default => 100,
        };

        return [
            'id' => 'QST' . Str::random(5),
            'points' => $points,
            'titre' => $this->faker->randomElement([
                "$category: ",
                "Challenge $category: ",
                "$level $category: ",
                ""
            ]) . $this->faker->unique()->catchPhrase(),
            'description' => $this->faker->paragraphs(2, true),
            'level' => $level,
            'hint' => $this->faker->boolean(70) ? $this->faker->sentence() : null,
            'hint_point' => $this->faker->boolean(70) ? (string)($points/4) : 'None',
            'file' => $this->faker->boolean(60) ? "challenge_" . Str::random(8) . ".zip" : null,
            'path' => function (array $attributes) {
                return $attributes['file']
                    ? "/challenges/files/" . $attributes['file']
                    : null;
            },
            'category' => $category,
            'solved_by' => $this->faker->numberBetween(0, 50),
            'flag' => "hack_CTF{" . Str::random(32) . "}",
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => function (array $attributes) {
                return $attributes['created_at'];
            },
        ];
    }

    // État pour un challenge facile
    public function easy()
    {
        return $this->state(function (array $attributes) {
            return [
                'level' => 'Easy',
                'points' => $this->faker->randomElement([100, 200]),
                'solved_by' => $this->faker->numberBetween(20, 50),
            ];
        });
    }

    // État pour un challenge difficile
    public function hard()
    {
        return $this->state(function (array $attributes) {
            return [
                'level' => 'Hard',
                'points' => $this->faker->randomElement([500, 600]),
                'solved_by' => $this->faker->numberBetween(0, 10),
            ];
        });
    }
}
