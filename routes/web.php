<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CtfController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChallengesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/404', function () {
    return view('404');
})->name('404');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/instructions', function () {
        return view('instructions');
    })->name('instructions');
});

Route::middleware('auth')->group(function () {
    Route::get('/questions', [CtfController::class, 'Quest'])->name('questions');
    Route::post('/check', [CtfController::class, 'check'])->name('check_flag');
    Route::get('/get-hint', [CtfController::class, 'hint'])->name('get-hint');
    Route::get('/leaderboard', [CtfController::class, 'leaderboard'])->name('leaderboard');
    Route::get('/download-file/{questionId}', [CtfController::class, 'downloadFile'])->name('download.file');
    Route::get('/uploadWriteups', [CtfController::class, 'writeups'])->name('writeups');
    Route::post('/uploadWriteups', [CtfController::class, 'uploadWriteups'])->name('uploadWriteups');

});

//Route connexion admin

Route::get('/admin/login_hacktivits@@2022', [AdminController::class, 'login']);
Route::post('/admin/login_hacktivits@@2022', [AdminController::class, 'store'])->name('admin.login');
Route::post('/deconnexion', [AdminController::class, 'deconnexion'])->name('admin.deconnexion');

//Middleware admin

Route::middleware('isAdmin')->group(function () {

    Route::get('/admin/dashboard_hacktivits@@2022', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::resource('challenges', ChallengesController::class);

    Route::resource('user', UserController::class);

    Route::post('/store-question', [CtfController::class, 'storeQ'])->name('store.question');
});

require __DIR__ . '/auth.php';
