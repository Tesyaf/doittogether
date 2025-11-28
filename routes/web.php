<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\TeamController;

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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'callback']);

Route::middleware(['auth'])->group(function () {

    // SHOW PROFILE
    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.show');

    // EDIT PROFILE PAGE
    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    // UPDATE PROFILE
    Route::put('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

    // UPDATE PASSWORD
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password');

    Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');

    Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
    Route::post('/teams', [TeamController::class, 'store'])->name('teams.store');

    Route::get('/teams/switch/{team}', [TeamController::class, 'switch'])->name('teams.switch');

    Route::get('/teams/{team}/edit', [TeamController::class, 'edit'])->name('teams.edit');
    Route::put('/teams/{team}', [TeamController::class, 'update'])->name('teams.update');
});

require __DIR__ . '/auth.php';
