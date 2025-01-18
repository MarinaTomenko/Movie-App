<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MemberController;

Route::get('/', function () {
    return view('welcome');
});


//Route::get('/films', [FilmController::class, 'index'])->name('films');
Route::get('/series', [SeriesController::class, 'show'])->name('series');
Route::get('/members', [MemberController::class, 'show'])->name('members');
Route::get('/lists', [ListController::class, 'show'])->name('lists');
Route::get('/blog', [BlogController::class, 'show'])->name('blog');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/films', [FilmController::class, 'index'])->name('films');
});

require __DIR__.'/auth.php';
