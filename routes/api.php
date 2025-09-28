<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;

Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

Route::get('/weather', [WeatherController::class, 'weather']);