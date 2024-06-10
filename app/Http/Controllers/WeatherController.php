<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Weather;
use Illuminate\Http\Request;
use Carbon\Carbon;

class WeatherController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $token = $request->query('token');

        if (!$token) {
            die('Unauthorized. Token not provided.');
        }

        $token = explode('_', $token);
        $tokenName = trim($token[0]);
        $tokenHash = hash('sha256', trim($token[1]) );

        $user = User::where('name', $tokenName)->first();
        if (!$user || $user->token != $tokenHash) {
            die('Unauthorized. Invalid token.');
        }
    }
    /**
     * Retrieve all weather data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Weather::all());
    }

    /**
     * Retrieve the latest weather data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function current()
    {
        return response()->json(Weather::latest('time')->first());
    }

    /**
     * Retrieve weather forecast for a number of days.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function forecast(Request $request)
    {
        // Get the number of days for the forecast; default is 3 days
        $days = $request->query('days', 3);

        // Calculate the date range for the forecast
        $endDate = Carbon::now();
        $startDate = $endDate->copy()->subDays($days);

        // Retrieve weather data within the date range
        return response()->json(
            Weather::whereBetween('time', [$startDate, $endDate])
                ->orderBy('time', 'asc')
                ->get()
        );
    }

    /**
     * Retrieve weather data for a specific period.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function history(Request $request)
    {
        // Validate the date inputs
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // Parse the dates from the request
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        // Retrieve weather data within the specified period
        return response()->json(
            Weather::whereBetween('time', [$startDate, $endDate])
                ->orderBy('time', 'asc')
                ->get()
        );
    }

    /**
     * Retrieve weather data for a specific hour.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function hourly(Request $request)
    {
        // Validate the date and time input
        $request->validate([
            'date_time' => 'required|date_format:Y-m-d/H',
        ]);

        // Parse the date and time from the request
        $dateTime = Carbon::createFromFormat('Y-m-d/H', $request->date_time);

        // Retrieve weather data for the specified hour
        return response()->json(
            Weather::where('time', $dateTime)->first()
        );
    }

    /**
     * Retrieve daily averages of weather parameters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function dailyAverages(Request $request)
    {
        // Validate the date input
        $request->validate([
            'date' => 'required|date',
        ]);

        // Parse the date from the request and set the start and end of the day
        $date = Carbon::parse($request->date)->startOfDay();
        $nextDay = $date->copy()->addDay();

        // Calculate and retrieve average weather data for the day
        return response()->json(
            Weather::selectRaw('
                    AVG(air_temperature_noaa) as avg_air_temperature_noaa,
                    AVG(air_temperature_sg) as avg_air_temperature_sg,
                    AVG(humidity_noaa) as avg_humidity_noaa,
                    AVG(humidity_sg) as avg_humidity_sg,
                    AVG(pressure_noaa) as avg_pressure_noaa,
                    AVG(pressure_sg) as avg_pressure_sg,
                    AVG(wind_direction_noaa) as avg_wind_direction_noaa,
                    AVG(wind_direction_sg) as avg_wind_direction_sg,
                    AVG(wind_speed_noaa) as avg_wind_speed_noaa,
                    AVG(wind_speed_sg) as avg_wind_speed_sg
                ')
                ->whereBetween('time', [$date, $nextDay])
                ->first()
        );
    }

    /**
     * Retrieve the average temperature for a specific period.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function averageTemperature(Request $request)
    {
        // Validate the date inputs
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // Parse the dates from the request
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        // Calculate and retrieve average temperature data for the specified period
        return response()->json(
            Weather::whereBetween('time', [$startDate, $endDate])
                ->avg('air_temperature_noaa')
        );
    }

    /**
     * Retrieve the maximum and minimum temperature for a specific period.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function temperatureExtremes(Request $request)
    {
        // Validate the date inputs
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // Parse the dates from the request
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        // Calculate and retrieve maximum and minimum temperature data for the specified period
        return response()->json([
            'max_temperature' => Weather::whereBetween('time', [$startDate, $endDate])
                ->max('air_temperature_noaa'),
            'min_temperature' => Weather::whereBetween('time', [$startDate, $endDate])
                ->min('air_temperature_noaa')
        ]);
    }

    /**
     * Retrieve the average wind speed for a specific period.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function averageWindSpeed(Request $request)
    {
        // Validate the date inputs
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // Parse the dates from the request
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        // Calculate and retrieve average wind speed data for the specified period
        return response()->json(
            Weather::whereBetween('time', [$startDate, $endDate])
                ->avg('wind_speed_noaa')
        );
    }

    /**
     * Retrieve the average pressure for a specific period.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function averagePressure(Request $request)
    {
        // Validate the date inputs
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // Parse the dates from the request
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        // Calculate and retrieve average pressure data for the specified period
        return response()->json(
            Weather::whereBetween('time', [$startDate, $endDate])
                ->avg('pressure_noaa')
        );
    }

    /**
     * Retrieve the average humidity for a specific period.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function averageHumidity(Request $request)
    {
        // Validate the date inputs
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // Parse the dates from the request
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        // Calculate and retrieve average humidity data for the specified period
        return response()->json(
            Weather::whereBetween('time', [$startDate, $endDate])
                ->avg('humidity_noaa')
        );
    }

}
