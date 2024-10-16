<?php

use App\Models\Series;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\SeriesController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('/series', SeriesController::class);

Route::get('/series/{series}/seasons', function (Series $series) {
    return $series->seasons;
});

Route::get('/series/{series}/episodes', function (Series $series) {
    return $series->episodes()->orderBy('id')->get();
});

Route::patch('/episodes/{episode}', function (Episode $episode, Request $request) {
    $episode->watched = $request->watched;
    $episode->save();
    return $episode;
});
