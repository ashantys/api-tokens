<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\CharacterTokenController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/series', SerieController::class);
Route::apiResource('/characters', CharacterController::class);
Route::apiResource('/tokens', CharacterTokenController::class);
