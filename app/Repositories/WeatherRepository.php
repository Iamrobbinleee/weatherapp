<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;
use App\Repositories\Interfaces\WeatherInterface;

class WeatherRepository implements WeatherInterface
{
    public function getCurrentWeather($latitude, $longitude)
    {
        $response = Http::get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'current' => 'temperature_2m,relative_humidity_2m,wind_speed_10m,pressure_msl,visibility',
        ]);

        return $response->json();
    }

    public function getSevenDaysForecast($latitude, $longitude)
    {
        $response = Http::get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'daily' => 'temperature_2m_max,temperature_2m_min',
            'forecast_days' => 7,
        ]);

        return $response->json();
    }

    public function getTwentyFourHoursForecast($latitude, $longitude)
    {
        $response = Http::get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'hourly' => 'temperature_2m',
            'forecast_hours' => 24,
        ]);

        return $response->json();
    }

    public function getLocationDetails($location_name)
    {
        $response = Http::get('https://geocoding-api.open-meteo.com/v1/search', [
            'name'         => $location_name,
            'country_code' => 'PH',
            'count'        => 1,
            'language'     => 'en',
            'format'       => 'json'
        ]);

        return $response->json();
    }
}
