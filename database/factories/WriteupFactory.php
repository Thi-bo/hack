<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Writeup>
 */
class WriteupFactory extends Factory
{
    public function definition()
    {
        // Génération de notes cohérentes
        $generateRating = fn() => (string)$this->faker->numberBetween(3, 5);
        $experienceGlobale = $generateRating();

        return [
            'id' => 'WRT' .Str::random(5),
            'faciliteAcces' => $generateRating(),
            'interfaceUtilisateur' => $generateRating(),
            'noteQuestion' => $generateRating(),
            'noteIndice' => $generateRating(),
            'experienceUtilisateur' => $generateRating(),
            'isRejouer' => $generateRating(),
            'recommandation' => $generateRating(),
            'soutienOrganisateur' => $generateRating(),
            'exeprienceGlobale' => $experienceGlobale,
            'commentaires' => $this->faker->boolean(80) ? $this->faker->paragraph() : null,
            'nomFichier' => function (array $attributes) {
                return 'writeup_' . Str::random(8) . '.pdf';
            },
            'pathFichier' => function (array $attributes) {
                return '/writeups/' . $attributes['nomFichier'];
            },
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => function (array $attributes) {
                return $attributes['created_at'];
            },
        ];
    }

    // État pour un feedback très positif
    public function positive()
    {
        return $this->state(function (array $attributes) {
            return [
                'faciliteAcces' => '5',
                'interfaceUtilisateur' => '5',
                'noteQuestion' => '5',
                'noteIndice' => '5',
                'experienceUtilisateur' => '5',
                'isRejouer' => '5',
                'recommandation' => '5',
                'soutienOrganisateur' => '5',
                'exeprienceGlobale' => '5',
                'commentaires' => $this->faker->randomElement([
                    'Excellent CTF! Very well organized and great challenges.',
                    'One of the best CTF experiences I\'ve had. Will definitely participate again!',
                    'Amazing platform and support team. Loved every challenge.',
                ]),
            ];
        });
    }
}
