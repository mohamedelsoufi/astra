<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\DataController;

Route::get('/', [DataController::class, 'match'])->name('match');
Route::post('/map', [DataController::class, 'map'])->name('map');
Route::get('/match-results', [DataController::class, 'matchResults'])->name('matchResults');
