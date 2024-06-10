<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\WeatherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/token', [AuthenticationController::class, 'token']);
Route::get('/weather', [WeatherController::class, 'index']);
Route::get('/weather/current', [WeatherController::class, 'current']);
Route::get('/weather/forecast', [WeatherController::class, 'forecast']);
Route::get('/weather/history', [WeatherController::class, 'history']);
Route::get('/weather/hourly', [WeatherController::class, 'hourly']);
Route::get('/weather/daily-averages', [WeatherController::class, 'dailyAverages']);
Route::get('/weather/average-temperature', [WeatherController::class, 'averageTemperature']);
Route::get('/weather/temperature-extremes', [WeatherController::class, 'temperatureExtremes']);
Route::get('/weather/average-wind-speed', [WeatherController::class, 'averageWindSpeed']);
Route::get('/weather/average-pressure', [WeatherController::class, 'averagePressure']);
Route::get('/weather/average-humidity', [WeatherController::class, 'averageHumidity']);

