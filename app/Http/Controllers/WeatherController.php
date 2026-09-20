<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WeatherController extends Controller
{
    private $cities = [
        'Dublin' => ['lat' => 53.3498, 'lon' => -6.2603],
        'Cork' => ['lat' => 51.8985, 'lon' => -8.4756],
        'Galway' => ['lat' => 53.2707, 'lon' => -9.0568],
        'Limerick' => ['lat' => 52.6638, 'lon' => -8.6267],
        'Waterford' => ['lat' => 52.2593, 'lon' => -7.1101],
        'Donegal' => ['lat' => 54.6548, 'lon' => -8.1095],
        'Kerry' => ['lat' => 52.1545, 'lon' => -9.5669],
    ];

    public function index()
    {
        $apiKey = env('WEATHER_API_KEY');
        
        $weatherData = Cache::remember('weather_index_grid', 60 * 60, function () use ($apiKey) {
            $data = [];
            foreach ($this->cities as $name => $coords) {
                $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
                    'lat' => $coords['lat'],
                    'lon' => $coords['lon'],
                    'units' => 'metric',
                    'appid' => $apiKey
                ]);

                if ($response->successful()) {
                    $json = $response->json();
                    
                    // Parse condition and get emoji icon using your helper
                    $parsed = $this->parseWeatherCondition($json['weather'][0]['description'] ?? '');

                    $data[] = [
                        'name' => $name,
                        'lat' => $coords['lat'],
                        'lon' => $coords['lon'],
                        'temp' => round($json['main']['temp']),
                        'condition' => $parsed['condition'], // Fixed key
                        'icon' => $parsed['icon'],             // Fixed emoji icon
                        'humidity' => $json['main']['humidity'],
                        'wind' => $json['wind']['speed'],
                    ];
                }
            }
            return $data;
        });

        return view('welcome', ['weatherData' => $weatherData, 'apiKey' => $apiKey]);
    }

    public function show($cityName)
{
    $apiKey = env('WEATHER_API_KEY');
    
    // Find the city coordinates from your array
    $capitalizedName = ucfirst(strtolower($cityName));
    
    if (!isset($this->cities[$capitalizedName])) {
        abort(404, 'City not found.');
    }

    $coords = $this->cities[$capitalizedName];
    $cacheKey = 'city_detail_' . strtolower($cityName);

    $weatherData = Cache::remember($cacheKey, 60 * 60, function () use ($coords, $capitalizedName, $apiKey) {
        $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'lat' => $coords['lat'],
            'lon' => $coords['lon'],
            'units' => 'metric',
            'appid' => $apiKey
        ]);

        if (!$response->successful()) {
            return null;
        }

        $data = $response->json();
        $rawDesc = $data['weather'][0]['description'] ?? 'Clear sky';
        $parsed = $this->parseWeatherCondition($rawDesc);

        return [
            'name' => $capitalizedName,
            'temp' => round($data['main']['temp'] ?? 0),
            'feels_like' => round($data['main']['feels_like'] ?? 0),
            'temp_min' => round($data['main']['temp_min'] ?? 0),
            'temp_max' => round($data['main']['temp_max'] ?? 0),
            'condition' => $parsed['condition'],
            'description' => $rawDesc, // Explicitly safe key
            'icon' => $parsed['icon'],
            'humidity' => $data['main']['humidity'] ?? 0,
            'pressure' => $data['main']['pressure'] ?? 1013,
            'wind' => $data['wind']['speed'] ?? 0,
            'clouds' => $data['clouds']['all'] ?? 0,
            'forecast' => [] // Add your forecast logic if you have it
        ];
    });

    if (!$weatherData) {
        abort(404, 'Unable to fetch weather data.');
    }

    return view('city-detail', ['weather' => $weatherData]);
}

    private function parseWeatherCondition($condition)
    {
        $condition = strtolower($condition);
        $icon = '⛅';

        if (str_contains($condition, 'rain') || str_contains($condition, 'drizzle')) {
            $icon = '🌧️';
        } elseif (str_contains($condition, 'clear') || str_contains($condition, 'sun')) {
            $icon = '☀️';
        } elseif (str_contains($condition, 'thunder')) {
            $icon = '⚡';
        } elseif (str_contains($condition, 'snow')) {
            $icon = '❄️';
        } elseif (str_contains($condition, 'mist') || str_contains($condition, 'fog')) {
            $icon = '🌫️';
        }

        return ['condition' => $condition, 'icon' => $icon];
    }
}