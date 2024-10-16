<?php

use App\Mail\SeriesCreated;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\EpisodesController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/', function () {
        return redirect('/series');
    });

    Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])->name('seasons.index');

    Route::get('/seasons/{season}/episodes', [EpisodesController::class, 'index'])->name('episodes.index');
    Route::post('/seasons/{season}/episodes', [EpisodesController::class, 'update'])->name('episodes.update');
});
Route::resource('/series', SeriesController::class)->except('show');

Route::get('/email', function () {
    return new SeriesCreated(
        'Série de teste',
        1,
        5,
        10
    );
});
require __DIR__ . '/auth.php';
