<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DashboardController;
Route::get('/', function () {
    return view('welcome');
});


//Route::get('/films', [FilmController::class, 'index'])->name('films');


//Route::get('/dashboard', function () {
 //   return view('dashboard');
//})->middleware(['auth', 'verified'])->name//('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/films', [FilmController::class, 'index'])->name('films');
    Route::get('/movies/search', [MovieController::class, 'search'])->name('movies.search');
    Route::get('/films/{id}/view', [FilmController::class, 'view'])->name('films.view');
    Route::get('/series', [SeriesController::class, 'show'])->name('series');
    Route::get('/members', [MemberController::class, 'show'])->name('members');
    Route::get('/collections', [CollectionController::class, 'index'])->name('collections.index');
    Route::get('/collections/create', [CollectionController::class, 'create'])->name('collections.create');
    Route::post('/collections/store', [CollectionController::class, 'store'])->name('collections.store');
    Route::get('/collections/{id}/view', [CollectionController::class, 'view'])->name('collections.view');
    Route::get('/blog', [BlogController::class, 'show'])->name('blog');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
   
});

require __DIR__.'/auth.php';
