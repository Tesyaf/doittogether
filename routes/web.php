<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamDashboardController;
use App\Http\Controllers\UserDashboardController;

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

// Dashboard pengguna (global)
Route::get('/dashboard', [UserDashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// Dashboard team
Route::get('/teams/{team}', [TeamDashboardController::class, 'index'])
    ->middleware(['auth', 'team'])
    ->name('teams.dashboard');



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

    Route::get('/teams/switch/{id}', [TeamController::class, 'switch'])->name('teams.switch');

    Route::get('/teams/{team}', [TeamController::class, 'dashboard'])->name('teams.dashboard');

    Route::get('/teams/{team}/members', [TeamController::class, 'members'])->name('teams.members');
    Route::get('/teams/{team}/invite', [TeamController::class, 'invite'])->name('teams.invite');
    Route::get('/teams/{team}/invitations', [TeamController::class, 'pendingInvitations'])->name('teams.invitations.pending');

    Route::get('/teams/{team}/activity', [TeamController::class, 'activityLog'])->name('teams.activity');
    Route::get('/teams/{team}/notifications', [TeamController::class, 'notifications'])->name('teams.notifications');

    Route::get('/teams/{team}/settings', [TeamController::class, 'settings'])->name('teams.settings');
    Route::put('/teams/{team}/settings', [TeamController::class, 'updateSettings'])->name('teams.settings.update');
});

require __DIR__ . '/auth.php';
