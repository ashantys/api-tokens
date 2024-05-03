<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\SerieController;

Route::apiResource('characters', CharacterController::class);
Route::apiResource('series', SerieController::class);



