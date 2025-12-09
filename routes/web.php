<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskCommentController;
use App\Http\Controllers\TaskAttachmentController;
use App\Http\Controllers\TaskAssigneeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TeamRepositoryController;
use App\Http\Controllers\GitHubWebhookController;
use App\Http\Controllers\TeamDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\MasterTaskStatusController;
use App\Http\Controllers\Admin\MasterTaskPriorityController;
use App\Http\Controllers\CalendarFeedController;
use App\Http\Controllers\CalendarIntegrationController;

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

Route::view('/', 'welcome')->name('landing');
Route::view('/about', 'about')->name('about');
Route::view('/manfaat', 'manfaat')->name('manfaat');

Route::post('/webhooks/github/app', [GitHubWebhookController::class, 'handleApp'])->name('webhooks.github.app');
Route::post('/webhooks/github/{teamRepository}', [GitHubWebhookController::class, 'handle'])->name('webhooks.github');

Route::get('auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'callback']);

Route::middleware(['auth'])->group(function () {
    // Dashboard pengguna (global)
    Route::get('/dashboard', [UserDashboardController::class, 'index'])
        ->middleware('verified_or_admin')
        ->name('dashboard');

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

    // Google Calendar integration (API)
    Route::get('/calendar/connect', [CalendarIntegrationController::class, 'redirect'])->name('calendar.connect');
    Route::get('/calendar/connect/callback', [CalendarIntegrationController::class, 'callback'])->name('calendar.callback');
    Route::post('/calendar/disconnect', [CalendarIntegrationController::class, 'disconnect'])->name('calendar.disconnect');
    Route::post('/calendar/sync', [CalendarIntegrationController::class, 'sync'])->name('calendar.sync');

    Route::middleware('verified_or_admin')->group(function () {
        Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
        Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
        Route::post('/teams', [TeamController::class, 'store'])->name('teams.store');
        Route::get('/teams/switch/{id}', [TeamController::class, 'switch'])->name('teams.switch');

        Route::get('/teams/{team}', [TeamController::class, 'dashboard'])->name('teams.dashboard');

        Route::get('/teams/{team}/members', [TeamController::class, 'members'])->name('teams.members');
        Route::get('/teams/{team}/invite', [TeamController::class, 'invite'])->name('teams.invite');
        Route::post('/teams/{team}/invite', [TeamController::class, 'sendInvite'])->name('teams.invite.store');
        Route::get('/teams/{team}/invitations', [TeamController::class, 'pendingInvitations'])->name('teams.invitations.pending');
        Route::post('/teams/{team}/invitations/{invitation}/resend', [TeamController::class, 'resendInvitation'])->name('teams.invitations.resend');
        Route::delete('/teams/{team}/invitations/{invitation}', [TeamController::class, 'cancelInvitation'])->name('teams.invitations.cancel');

        Route::get('/teams/{team}/activity', [TeamController::class, 'activityLog'])->name('teams.activity');
        Route::get('/teams/{team}/notifications', [TeamController::class, 'notifications'])->name('teams.notifications');

        Route::get('/teams/{team}/settings', [TeamController::class, 'settings'])->name('teams.settings');
        Route::put('/teams/{team}/settings', [TeamController::class, 'updateSettings'])->name('teams.settings.update');

        Route::post('/teams/{team}/leave', [TeamController::class, 'leave'])->name('teams.leave');

        // REPOSITORY & COMMITS
        Route::get('/teams/{team}/repo', [TeamRepositoryController::class, 'edit'])->name('repositories.edit');
        Route::post('/teams/{team}/repo', [TeamRepositoryController::class, 'upsert'])->name('repositories.upsert');
        Route::delete('/teams/{team}/repo', [TeamRepositoryController::class, 'disconnect'])->name('repositories.disconnect');
        Route::get('/teams/{team}/commits', [TeamRepositoryController::class, 'commits'])->name('repositories.commits');

        // TASK ROUTES (nested dalam team)
        Route::get('/teams/{team}/tasks', [TaskController::class, 'index'])->name('tasks.index');
        Route::get('/teams/{team}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('/teams/{team}/tasks', [TaskController::class, 'store'])->name('tasks.store');
        Route::get('/teams/{team}/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
        Route::get('/teams/{team}/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
        Route::put('/teams/{team}/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
        Route::delete('/teams/{team}/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

        // TASK COMMENTS
        Route::post('/teams/{team}/tasks/{task}/comments', [TaskCommentController::class, 'store'])->name('tasks.comments.store');

        // TASK ATTACHMENTS
        Route::post('/teams/{team}/tasks/{task}/attachments', [TaskAttachmentController::class, 'store'])->name('tasks.attachments.store');
        Route::delete('/teams/{team}/tasks/{task}/attachments/{attachment}', [TaskAttachmentController::class, 'destroy'])->name('tasks.attachments.destroy');

        // TASK ASSIGNEES
        Route::post('/teams/{team}/tasks/{task}/assignees', [TaskAssigneeController::class, 'store'])->name('tasks.assignees.store');
        Route::delete('/teams/{team}/tasks/{task}/assignees/{memberId}', [TaskAssigneeController::class, 'destroy'])->name('tasks.assignees.destroy');

        // CATEGORY ROUTES
        Route::get('/teams/{team}/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/teams/{team}/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/teams/{team}/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/teams/{team}/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/teams/{team}/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/teams/{team}/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    // ADMIN PANEL (tanpa verifikasi email, hanya auth+admin)
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
        Route::post('/users/{user}/toggle-admin', [UserManagementController::class, 'toggleAdmin'])->name('users.toggle');

        Route::get('/master/statuses', [MasterTaskStatusController::class, 'index'])->name('master.statuses.index');
        Route::post('/master/statuses', [MasterTaskStatusController::class, 'store'])->name('master.statuses.store');
        Route::put('/master/statuses/{status}', [MasterTaskStatusController::class, 'update'])->name('master.statuses.update');
        Route::delete('/master/statuses/{status}', [MasterTaskStatusController::class, 'destroy'])->name('master.statuses.destroy');

        Route::get('/master/priorities', [MasterTaskPriorityController::class, 'index'])->name('master.priorities.index');
        Route::post('/master/priorities', [MasterTaskPriorityController::class, 'store'])->name('master.priorities.store');
        Route::put('/master/priorities/{priority}', [MasterTaskPriorityController::class, 'update'])->name('master.priorities.update');
        Route::delete('/master/priorities/{priority}', [MasterTaskPriorityController::class, 'destroy'])->name('master.priorities.destroy');
    });
});

require __DIR__ . '/auth.php';
