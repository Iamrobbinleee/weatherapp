<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Repositories\Interfaces\WeatherInterface;

class WeatherController extends Controller
{
    protected $weatherRepository;

    public function __construct(WeatherInterface $weatherRepository)
    {
        $this->weatherRepository = $weatherRepository;
    }

    public function index()
    {
        return view('weather-dashboard');
    }
    
    public function weather()
    {
        $latitude = 14.5995;
        $longitude = 120.9842;
        $location_name = "Manila";

        $currentWeather = $this->weatherRepository->getCurrentWeather($latitude, $longitude);
        $sevenDaysForecast = $this->weatherRepository->getSevenDaysForecast($latitude, $longitude);
        $twentyFourHrForecast = $this->weatherRepository->getTwentyFourHoursForecast($latitude, $longitude);
        $locationDetails = $this->weatherRepository->getLocationDetails($location_name);

        return response()->json([
            'currentWeather' => $currentWeather,
            'sevenDaysForecast' => $sevenDaysForecast,
            'twentyFourHrForecast' => $twentyFourHrForecast,
            'locationDetails' => $locationDetails
        ]);
    }

    public function myCurrentLocation(Request $request)
    {
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $location_name = "Batangas"; //Need to set to Dynamic

        $currentWeather = $this->weatherRepository->getCurrentWeather($latitude, $longitude);
        $sevenDaysForecast = $this->weatherRepository->getSevenDaysForecast($latitude, $longitude);
        $twentyFourHrForecast = $this->weatherRepository->getTwentyFourHoursForecast($latitude, $longitude);
        $locationDetails = $this->weatherRepository->getLocationDetails($location_name);

        return response()->json([
            'currentWeather' => $currentWeather,
            'sevenDaysForecast' => $sevenDaysForecast,
            'twentyFourHrForecast' => $twentyFourHrForecast,
            'locationDetails' => $locationDetails
        ]);
    }
}
