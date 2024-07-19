<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AstronomyPictureOfTheDayController;

Route::middleware('api')->group(function () {
   Route::get('/apod', AstronomyPictureOfTheDayController::class);
});
