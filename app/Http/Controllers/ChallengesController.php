<?php

namespace App\Http\Controllers;

use App\Models\Questions;
use Illuminate\Http\Request;

class ChallengesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $challenges = Questions::all();
        return view('admin.challenges', compact('challenges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('admin.challenges_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

       // dd($request);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
       // dd($id);
       $challenge = Questions::find($id);
       return view('admin.challenges_edit', compact('challenge'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $challenge = Questions::findOrFail($id);

        $challenge->fill($request->only([
            'titre', 'points', 'description', 'level', 'hint', 'hint_point', 'file', 'category', 'flag'
        ]));

        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            $fileName = $uploadedFile->getClientOriginalName();
            $path = $uploadedFile->store('challenges_img', 'public');
            $challenge->file = $fileName;
            $challenge->path = $path;

        }

        $challenge->save();

        return redirect()->route('challenges.index')->with('status', 'Challenge mis à jour avec succès!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
