<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AstronomyPictureOfTheDayController;
use App\Http\Controllers\EarthPolychromaticImagingCameraController;
use App\Http\Controllers\MarsRoverPhotosController;

Route::middleware('auth:sanctum')->group(function () {
   Route::get('/apod', AstronomyPictureOfTheDayController::class);
   Route::get('/epic', EarthPolychromaticImagingCameraController::class);
   Route::get('/mars', MarsRoverPhotosController::class);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});


