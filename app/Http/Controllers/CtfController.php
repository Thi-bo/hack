<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Submission;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Writeup;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CtfController extends Controller


{


    private function tmer()
    {
        $start = "2022-12-22 00:00:00";
        $starttime = new DateTime($start);

        // Calculer le nombre total de secondes écoulées depuis minuit
        return $starttime;
    }

    private function timer()
    {
        $start = "2023-12-22 00:00:00";
        # dd($start);
        return new DateTime($start);
    }

    private function calc()
    {
        $now = new DateTime(); // Utiliser DateTime pour la date actuelle
        $starttime = $this->timer();
        $diff = $now->diff($starttime);

        // Ajouter 100 ans au lieu de 48 heures
        $endtime = $this->timer();
        $endtime->add(new DateInterval('P100Y')); // Add 100 years to the start time

        $total_seconds = $diff->s + $diff->i * 60 + $diff->h * 3600 + $diff->d * 86400; // Calculer le nombre total de secondes, jours inclus

        // Formater la différence en jours, heures, minutes, secondes
        $sub_time = gmdate("j \d\a\y\s H:i:s", $total_seconds);

        return [
            'now' => $now,
            'starttime' => $starttime,
            'diff' => $diff,
            'endtime' => $endtime,
            'total_seconds' => $total_seconds,
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
            $user = User::where('id', $users->id)->first();
            $userprofile = UserProfile::where('user_id', $users->id)->first();
            $questions = Question::get();
            $submission = Submission::where('user_id', $users->id)->orderBy('question_id')->get();
            # dd($userprofile);
            # dd($Question->submissions());
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
            $quest = Question::findOrFail($Qid);

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
                    $solved->sub_time = gmdate("j \d\a\y\s H:i:s",  $sec['total_seconds']);;
                    $userProfile->last_sub_time = $solved->sub_time;
                    $quest->solved_by += 1;

                    $solved->solved = 1;
                    $userProfile->totlesub += 1;
                    $quest->save();
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
            return redirect()->back();
        }
    }

    public function hint(Request $request)
    {
        $question = Question::find($request->input('id'));
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
        $SubmissionHinted = Submission::where('question_id', $question->id)
            ->where('user_id', $userProfile->id)
            ->where('solved', 0)
            ->where('hinted', 1)
            ->first();

        if ($SubmissionSolved or $SubmissionHinted) {
            // Si la question a déjà été résolue, renvoyer l'indice
            return response()->json(['hint' => $hint]);
        } else {
            // Si la question n'a pas encore été résolue
            $submission = new Submission();
            $userProfile->score -= $hintsPoint;
            $submission->question_id = $question->id;
            $submission->user_id = $userProfile->id;
            $sec = $this->calc();
            $submission->solved = 0;
            $submission->hinted = 1;
            $submission->sub_time = gmdate("j \d\a\y\s H:i:s",  $sec['total_seconds']);
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


    public function leaderboard(Request $request)
{
    // Obtenez les utilisateurs triés par score et temps de dernière soumission
    $sortedUsers = UserProfile::with('user')
    ->orderByDesc('score')
    ->orderBy('last_sub_time', 'desc')
    ->get();

    // Préparez les données pour le graphique
    $chartData = [
        'labels' => $sortedUsers->pluck('user.name')->toArray(),
        'data' => $sortedUsers->pluck('score')->toArray(),
    ];

    // Calculez les statistiques globales
    $totalChallenges = Question::count(); // Supposons que vous ayez un modèle Challenge
    $totalPoints = $sortedUsers->sum('score'); // Somme des scores
    $maxScore = 5000; // Score maximum parmi les utilisateurs

    return view('hackerboard', compact('sortedUsers', 'chartData', 'totalChallenges', 'totalPoints', 'maxScore'));
}



    public function storeQ(Request $request)
    {
        try {
            // Validation des données, y compris le champ de fichier
            $validatedData = $request->validate([
                'points' => 'required|string',
                'titre' => 'required|string',
                'flag' => 'required|string',
                'description' => 'required|string',
                'level' => 'required',
                'category' => 'required',
                // 'file' => 'nullable|file',
            ]);

            // Gestion du fichier
            // $name="";
            // $path= "";
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = $file->store('challenges_img', 'public');
                $name = $file->getClientOriginalName();
            }

            $question = Question::create([
                'points' => $validatedData['points'],
                'titre' => $validatedData['titre'],
                'description' => $validatedData['description'],
                'level' => $validatedData['level'],
                'hint' => $request->input('hint'),
                'flag' => $validatedData['flag'],
                'hint_point' => $request->input('hint_point'),
                'file' => $name,
                'path' => $path,
                'category' => $validatedData['category'],
            ]);

            return redirect()->back()->with('status', 'Question enregistrée avec succès!');
        } catch (\Exception $e) {
            // Gérer l'exception ici (par exemple, journalisation, redirection avec un message d'erreur, etc.)
            return redirect()->back()->with('status', 'Une erreur est survenue lors de l\'enregistrement de la question. ' . $e->getMessage());
        }
    }


    public function downloadFile($questionId)
    {
        try {
            // Récupérer la question
            $question = Question::findOrFail($questionId);

            // Construire le chemin complet du fichier
            $filePath = storage_path("app/public/{$question->path}");

            // Vérifier si le fichier existe
            if (file_exists($filePath)) {
                // Télécharger le fichier
                return response()->download($filePath, $question->file);
            } else {
                // Gérer le cas où le fichier n'existe pas
                return redirect()->back()->with('error', 'Le fichier associé à cette question n\'existe pas.');
            }
        } catch (\Exception $e) {
            // Gérer l'exception ici (par exemple, journalisation, redirection avec un message d'erreur, etc.)
            return redirect()->back()->with('error', 'Une erreur est survenue lors du téléchargement du fichier.');
        }
    }


    public function writeups()
    {
        return view('writeups');
    }

    public function uploadWriteups(Request $request)
    {

      //  dd($request);

        $validatedData = $request->validate([
            'faciliteAcces' => 'required|string',
            'interfaceUtilisateur' => 'required|string',
            'noteQuestion' => 'required|string',
            'noteIndice' => 'required|string',
            'experienceUtilisateur' => 'required',
            'isRejouer' => 'required',
            'recommandation' => 'required',
            'soutienOrganisateur' => 'required',
            'exeprienceGlobale' => 'required',
            'commentaires' => 'required',
            'writeups' => 'required|file',
        ]);


        if ($request->hasFile('writeups')) {
            $file = $request->file('writeups');
            $path = $file->store('challenges_writeups', 'public');
            $name = $file->getClientOriginalName();
        }

        $user_name = Auth()->user()->name;

        $isWriteups = Writeup::where('user_name', $user_name)->first();

        if($isWriteups){
            return redirect()->back()->with('status', 'Vous avez déjà envoyé vos informations.');
        }

        else{
            $writeups = Writeup::create([
                'faciliteAcces' => $request->faciliteAcces,
                'interfaceUtilisateur' => $request->interfaceUtilisateur,
                'noteQuestion' =>  $request->noteQuestion,
                'noteIndice' =>  $request->noteIndice,
                'experienceUtilisateur' =>  $request->experienceUtilisateur,
                'isRejouer' =>  $request->isRejouer,
                'recommandation' =>  $request->recommandation,
                'soutienOrganisateur' =>  $request->soutienOrganisateur,
                'exeprienceGlobale' =>  $request->exeprienceGlobale,
                'commentaires' =>  $request->commentaires,
                'nomFichier'  =>  Auth()->user()->name.'_'.'writeups_'.$name,
                'pathFichier'  =>  $path,
                'user_id'  =>  Auth()->user()->id,
                'user_name'  =>  Auth()->user()->name,
            ]);

            return redirect()->back()->with('status', 'Vos information sont été envoyé avec succès.');
        }
    }
}
