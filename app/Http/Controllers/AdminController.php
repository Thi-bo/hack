<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{
    //

    public function login(){
return view('admin.login');
    }

    public function store(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (auth()->attempt($credentials)) {
            // Authentication successful
            return redirect()->route('admin.dashboard');
        } else {
            // Authentication failed
            return redirect()->back()->with('error', 'Identifiants incorrects.');
        }
    }

    public function dashboard(Request $request){
        return view('admin.dashboard');
    }

    public function deconnexion(Request $request){

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/admin/login_hacktivits@@2022');

    }
}
