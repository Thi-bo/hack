<?php

namespace Database\Seeders;

use Log;
use App\Models\User;
use App\Models\Writeup;
use App\Models\Question;
use App\Models\Submission;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MassDataSeeder extends Seeder
{
    public function run()
    {
        // Créer l'admin
        $admin = User::factory()->admin()->create();
        UserProfile::factory()->create([
            'user_id' => $admin->id,
            'score' => 5000,  // L'admin a testé tous les challenges
        ]);

        // Créer les utilisateurs réguliers et leurs profils
        $users = User::factory()->count(50)->create()->each(function ($user) {
            UserProfile::factory()->create([
                'user_id' => $user->id
            ]);
        });

        // Créer différents types de questions
        $easyQuestions = Question::factory()->count(20)->easy()->create();
        $mediumQuestions = Question::factory()->count(15)->create();
        $hardQuestions = Question::factory()->count(10)->hard()->create();
        $questions = $easyQuestions->concat($mediumQuestions)->concat($hardQuestions);

        // Générer des soumissions pour chaque utilisateur
        $users->each(function ($user) use ($questions) {
            // Sélectionner un nombre aléatoire de questions pour chaque utilisateur
            $selectedQuestions = $questions->random(rand(5, 30));

            foreach ($selectedQuestions as $question) {
                // Créer une ou plusieurs soumissions pour la même question
                $attempts = rand(1, 3);
                for ($i = 0; $i < $attempts; $i++) {
                    $solved = $i === $attempts - 1;  // Dernière tentative réussie

                    // Vérifiez si le profil d'utilisateur existe
                    if ($user->user_profile) {
                        Submission::factory()->create([
                            'user_id' => $user->user_profile->id,
                            'question_id' => $question->id,
                            'curr_score' => $solved ? $question->points : 0,
                            'solved' => $solved,
                        ]);
                    } else {
                        // Gérer le cas où le profil d'utilisateur est null
                        \Log::warning("User profile not found for user ID: {$user->id}");
                    }
                }
            }

            // 70% de chance que l'utilisateur soumette un writeup
            if (rand(1, 100) <= 70) {
                Writeup::factory()->create([
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                ]);
            }
        });

        // Mettre à jour les scores des utilisateurs
        $users->each(function ($user) {
            if ($user->user_profile) {
                $totalScore = Submission::where('user_id', $user->user_profile->id)
                    ->where('solved', 'true')
                    ->sum('curr_score');

                $lastSubmission = Submission::where('user_id', $user->user_profile->id)
                    ->latest('created_at')
                    ->first();

                $user->user_profile->update([
                    'score' => $totalScore,
                    'last_sub_time' => $lastSubmission ? $lastSubmission->created_at : null,
                ]);
            } else {
                \Log::warning("User profile not found for user ID: {$user->id}");
            }
        });

        // Mettre à jour le nombre de résolutions pour chaque question
        $questions->each(function ($question) {
            $solvedCount = Submission::where('question_id', $question->id)
                ->where('solved', 'true')
                ->count();

            $question->update([
                'solved_by' => $solvedCount
            ]);
        });
    }
}
