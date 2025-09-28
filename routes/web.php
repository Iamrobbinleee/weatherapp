<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;

Route::get('/', function () {
    return redirect('/weather-dashboard');
});

Route::get('/weather-dashboard', [WeatherController::class, 'index']);
