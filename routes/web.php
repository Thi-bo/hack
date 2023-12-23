<?php

use App\Http\Controllers\CtfController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
Route::post('/store-question', [CtfController::class, 'storeQ'])->name('store.question');
Route::get('/download-file/{questionId}', [CtfController::class, 'downloadFile'])->name('download.file');




    });


require __DIR__.'/auth.php';
