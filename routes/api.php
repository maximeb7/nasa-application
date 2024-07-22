<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AstronomyPictureOfTheDayController;
use App\Http\Controllers\EarthPolychromaticImagingCameraController;

Route::middleware('auth:sanctum')->group(function () {
   Route::get('/apod', AstronomyPictureOfTheDayController::class);
   Route::get('/epic', EarthPolychromaticImagingCameraController::class);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});


