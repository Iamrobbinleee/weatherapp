<?php

namespace App\Repositories\Interfaces;

interface WeatherInterface
{
    public function getCurrentWeather($latitude, $longitude);
    public function getSevenDaysForecast($latitude, $longitude);
    public function getTwentyFourHoursForecast($latitude, $longitude);
    public function getLocationDetails($location_name);
}