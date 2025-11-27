use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');   // nanti kita buat file landing.blade.php
})->name('landing');
