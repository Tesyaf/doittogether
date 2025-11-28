use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');   // nanti kita buat file landing.blade.php
})->name('landing');
use App\Http\Controllers\TaskController;

// ...

Route::middleware(['auth'])->group(function () {

    // ... route dashboard, join team, dll

    // ==============================
    // Task pages dalam konteks Team
    // ==============================
    Route::prefix('teams/{team}')->group(function () {
        Route::get('/tasks/board', [TaskController::class, 'board'])
            ->name('teams.tasks.board');

        Route::get('/tasks/list', [TaskController::class, 'index'])
            ->name('teams.tasks.list');

        Route::get('/tasks/calendar', [TaskController::class, 'calendar'])
            ->name('teams.tasks.calendar');

        Route::get('/tasks/my', [TaskController::class, 'my'])
            ->name('teams.tasks.my');

        Route::get('/tasks/{task}', [TaskController::class, 'show'])
            ->name('teams.tasks.show');
    });

});
