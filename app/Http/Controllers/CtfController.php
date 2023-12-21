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
            $hint = $question->Hint;
            $questionPoints = $question->points;

            $user = Auth::user(); // Utilisateur connecté
            $userProfile = UserProfile::where('user_id', $user->id)->first();
dd($hint);
            try {
                // Vérifier si la question a déjà été résolue par l'utilisateur
                $solved = Submission::where('question_id', $question->id)
                    ->where('user_id', $userProfile->id)
                    ->first();

                return response()->json(['hint' => $hint]);
            } catch (ModelNotFoundException $e) {
                // La question n'a pas encore été résolue par l'utilisateur
                $solved = new Submission();
                $userProfile->score -= $questionPoints * 0.1;
                $solved->question_id = $question->id;
                $solved->user_id = $userProfile->id;
                $solved->curr_score = $userProfile->score;
                $solved->save();
                $userProfile->save();

                return response()->json(['hint' => $hint]);
            }
        

        return view('ctf.404'); // Afficher la page 404 en cas de méthode non autorisée
    }


}
