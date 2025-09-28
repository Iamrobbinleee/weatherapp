<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {
        return view('weather-dashboard');
    }
    
    public function weather()
    {
        $latitude = 14.5995;   // Manila lat
        $longitude = 120.9842; // Manila lon

        $response = Http::get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'current_weather' => true,
        ]);

        return $response->json();
    }
}
