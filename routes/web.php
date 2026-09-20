<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WeatherController::class, 'index']);
Route::get('/city/{cityName}', [WeatherController::class, 'show']);
