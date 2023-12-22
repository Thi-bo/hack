<?php

namespace App\Http\Controllers;

use App\Models\Questions;
use App\Models\Submission;
use App\Models\User;
use App\Models\UserProfile;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Question\Question;

class CtfController extends Controller


{


    private function tmer()
    {
        $start = "2023-12-21 00:00:00";
        $starttime = new DateTime($start);

        // Calculer le nombre total de secondes écoulées depuis minuit
        return $starttime;
    }

    private function timer()
    {
        $start = "2023-12-21 00:00:00";
        return new DateTime($start);
    }

    private function calc()
    {
        $now = new DateTime(); // Utiliser DateTime pour la date actuelle
        $starttime = $this->timer();
        $diff = $now->getTimestamp() - $starttime->getTimestamp();
        $endtime = $this->timer();
        $endtime->add(new DateInterval('PT48H')); // Ajouter 48 heures à la date de début

        return [
            'now' => $now,
            'starttime' => $starttime,
            'diff' => $diff,
            'endtime' => $endtime,
        ];
    }

    public function Quest(Request $request)
    {
        $result = $this->calc();

        $starttime = $result['starttime'];
        $now = $result['now'];
        $endtime = $result['endtime'];


        // Comparaison des dates avec DateTime
        $interval = $now->diff($endtime);
        $isExpired = $interval->invert; // Si $interval->invert est égal à 1, cela signifie que la date est passée.
       # dd($isExpired);
        if (!$isExpired) {
            $users = Auth::user();
            $user = User::where('name', $users->id)->first();
            $userprofile = UserProfile::where('user_id', $users->id)->first();
            $questions = Questions::get();
            $submission = Submission::where('user_id', $users->id)->orderBy('question_id')->get();
            # dd($userprofile);
            # dd($questions->submissions());
            #dd($submission);

            // Utilisation de la vue Blade pour afficher les données
            return View('questions', compact('questions', 'submission', 'userprofile'));
        } else {
            return response()->json(['message' => 'Fin de challenge']);
        }
    }

    public function check(Request $request)
{
    try {
        $user = Auth::user();
        $userProfile = UserProfile::where('user_id', $user->id)->first();

        $Qid = $request->input('Qid');
        $flag = $request->input('flag');
        $quest = Questions::findOrFail($Qid);

        $solved = Submission::where('question_id', $quest->id)
            ->where('user_id', $userProfile->id)
            ->where('solved', true)
            ->first();

           
        if ($flag == $quest->flag) {
            if (!$solved) {
                $solved = new Submission();
                $userProfile->score += $quest->points;
                $solved->question_id = $quest->id;
                $solved->user_id = $userProfile->id;
                $solved->curr_score = $userProfile->score;

                $sec = $this->calc();

                $solved->sub_time = gmdate("H:i:s", $sec['diff']);
                $userProfile->last_sub_time = $solved->sub_time;
                $quest->solved_by += 1;

                $solved->solved = 1;
                $userProfile->totlesub += 1;

                $userProfile->save();
                $solved->save();

                return redirect()->back()->with('status', 'success')->with('message', 'Flag correct !');
            } else {
                return redirect()->back()->with('status', 'warning')->with('message', 'Vous avez déjà résolu cette question.');
            }
        } else {
            return redirect()->back()->with('status', 'error')->with('message', 'Flag incorrect !');
        }
    } catch (\Exception $e) {
        // Gérer l'exception ici
        return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
    }
}

public function hint(Request $request) {
    $question = Questions::find($request->input('id'));
    $hint = $question->hint;
    $hintsPoint = $question->hint_point;

    $user = Auth::user(); // Utilisateur connecté
    $userProfile = UserProfile::where('user_id', $user->id)->first();

    // Vérifier si la question a déjà été résolue par l'utilisateur
    $SubmissionSolved = Submission::where('question_id', $question->id)
        ->where('user_id', $userProfile->id)
        ->where('solved', 1)
        ->where('hinted', 0)
        ->first();
         $SubmissionHinted= Submission::where('question_id', $question->id)
        ->where('user_id', $userProfile->id)
        ->where('solved', 0)
        ->where('hinted', 1)
        ->first();

    if ($SubmissionSolved or $SubmissionHinted) {
        // Si la question a déjà été résolue, renvoyer l'indice
        return response()->json(['hinccct' => $hint]);
    } else {
        // Si la question n'a pas encore été résolue
        $submission = new Submission();
        $userProfile->score -= $hintsPoint;
        $submission->question_id = $question->id;
        $submission->user_id = $userProfile->id;
        $sec = $this->calc();
        $submission->solved = 0;
         $submission->hinted = 1;
        $submission->sub_time = gmdate("H:i:s", $sec['diff']);
        $submission->curr_score = $userProfile->score;
        
        // Enregistrer la soumission ou mettre à jour l'enregistrement existant s'il existe
          $userProfile->save();
        $submission->save();

      

        // Renvoyer l'indice
        return response()->json(['hint' => $hint]);
    }

    // La section suivante n'est atteinte que si la méthode n'est pas autorisée
    return view('ctf.404');
}


    public function leaderboard(Request $request) {
        // Obtenez les utilisateurs triés par score et temps de dernière soumission
        $sortedUsers = UserProfile::orderByDesc('score')
            ->orderBy('last_sub_time', 'desc')
            ->get();

        $submissions = Submission::select('question_id', 'user_id', 'sub_time')
            ->orderBy('user_id')
            ->orderBy('sub_time')
            ->get();

        $submissionsByUser = [];


        foreach ($submissions as $submission) {
            $submissionsByUser[$submission->user_id][] = $submission;
        }

        $userSubmissions = [];

        foreach ($sortedUsers as $user) {
            $userId = $user->id;

            // Vérifiez si des soumissions existent pour cet utilisateur
            if (isset($submissionsByUser[$userId])) {
                $userSubmissions[$userId] = $submissionsByUser[$userId];
            } else {
                $userSubmissions[$userId] = [];
            }
        }

return view('hackerboard', compact('userSubmissions', 'sortedUsers'));
    }



}