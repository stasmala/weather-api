<?php

namespace App\Console\Commands;

use App\Models\Weather;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateWeatherDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update weather data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Define the date range for querying weather data for the last 10 days
        $end = now()->startOfDay()->toIso8601ZuluString();
        $start = now()->subDays(9)->startOfDay()->toIso8601ZuluString(); // Start 10 days ago

        // Make a request to the Stormglass API
        $response = Http::withHeaders([
            'Authorization' => env('STORMGLASS_API_TOKEN'),
        ])->get('https://api.stormglass.io/v2/weather/point', [
            'lat' => env('CITY_LATITUDE'),
            'lng' => env('CITY_LONGITUDE'),
            'params' => implode(',', ['airTemperature', 'humidity', 'pressure', 'windSpeed', 'windDirection']),
            'start' => $start,
            'end' => $end,
        ]);

        // Check if the request was successful
        if ($response->successful()) {
            $weatherData = $response->json();

            // Process and save the data in the database
            $this->saveWeatherData($weatherData['hours']);

            $this->info('Weather data updated successfully.');
        } else {
            $this->error('Failed to fetch weather data: ' . $response->status());
        }
    }

    // Method to save weather data in the database
    private function saveWeatherData(array $hourlyData)
    {
        foreach ($hourlyData as $hourData) {
            // Search for weather records for the current hour
            $existingWeather = Weather::where('time', $hourData['time'])->first();

            if ($existingWeather) {
                // If the record exists, update the data
                $existingWeather->update([
                    'air_temperature_noaa' => $hourData['airTemperature']['noaa'] ?? null,
                    'air_temperature_sg' => $hourData['airTemperature']['sg'] ?? null,
                    'humidity_noaa' => $hourData['humidity']['noaa'] ?? null,
                    'humidity_sg' => $hourData['humidity']['sg'] ?? null,
                    'pressure_noaa' => $hourData['pressure']['noaa'] ?? null,
                    'pressure_sg' => $hourData['pressure']['sg'] ?? null,
                    'wind_direction_noaa' => $hourData['windDirection']['noaa'] ?? null,
                    'wind_direction_sg' => $hourData['windDirection']['sg'] ?? null,
                    'wind_speed_noaa' => $hourData['windSpeed']['noaa'] ?? null,
                    'wind_speed_sg' => $hourData['windSpeed']['sg'] ?? null,
                ]);
            } else {
                // If the record doesn't exist, create a new one
                Weather::create([
                    'time' => $hourData['time'],
                    'air_temperature_noaa' => $hourData['airTemperature']['noaa'] ?? null,
                    'air_temperature_sg' => $hourData['airTemperature']['sg'] ?? null,
                    'humidity_noaa' => $hourData['humidity']['noaa'] ?? null,
                    'humidity_sg' => $hourData['humidity']['sg'] ?? null,
                    'pressure_noaa' => $hourData['pressure']['noaa'] ?? null,
                    'pressure_sg' => $hourData['pressure']['sg'] ?? null,
                    'wind_direction_noaa' => $hourData['windDirection']['noaa'] ?? null,
                    'wind_direction_sg' => $hourData['windDirection']['sg'] ?? null,
                    'wind_speed_noaa' => $hourData['windSpeed']['noaa'] ?? null,
                    'wind_speed_sg' => $hourData['windSpeed']['sg'] ?? null,
                ]);
            }
        }
    }
}
