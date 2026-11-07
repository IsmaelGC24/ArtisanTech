<?php

namespace App\Util;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Throwable;

class MedellinWeather
{
    public function getCurrent(): array
    {
        $cached = Cache::get('medellin_weather');
        if ($cached !== null) {
            return $cached;
        }

        $data = $this->fetch();
        Cache::put('medellin_weather', $data, empty($data) ? 60 : 600);

        return $data;
    }

    private function fetch(): array
    {
        try {
            $response = Http::timeout(3)->get('https://api.open-meteo.com/v1/forecast', [
                'latitude' => 6.25,
                'longitude' => -75.56,
                'current' => 'temperature_2m,weather_code',
                'timezone' => 'America/Bogota',
            ]);
        } catch (Throwable $e) {
            return [];
        }

        $current = $response->json('current');
        if (! $response->successful() || ! is_array($current)) {
            return [];
        }

        return [
            'temperature' => (int) round($current['temperature_2m']),
            'condition' => $this->conditionFor((int) $current['weather_code']),
        ];
    }

    private function conditionFor(int $code): string
    {
        return match (true) {
            $code === 0 => 'clear',
            $code <= 3 => 'cloudy',
            in_array($code, [45, 48]) => 'fog',
            $code >= 95 => 'storm',
            ($code >= 51 && $code <= 67) || ($code >= 80 && $code <= 82) => 'rain',
            default => 'other',
        };
    }
}
