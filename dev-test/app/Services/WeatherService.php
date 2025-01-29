<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WeatherService
{
    protected $apiKey;
    protected $baseUrl = 'http://api.openweathermap.org/data/2.5';

    public function __construct()
    {
        $this->apiKey = config('services.openweathermap.key');
    }

    public function getCurrentWeather($city, $country = 'BR')
    {
        $cacheKey = "weather_{$city}_{$country}";

        return Cache::remember($cacheKey, 1800, function () use ($city, $country) {
            $response = Http::get("{$this->baseUrl}/weather", [
                'q' => "{$city},{$country}",
                'appid' => $this->apiKey,
                'units' => 'metric',
                'lang' => 'pt_br'
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            throw new \Exception('Não foi possível obter dados do clima');
        });
    }
}