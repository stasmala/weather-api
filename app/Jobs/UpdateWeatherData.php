<?php

namespace App\Jobs;

use App\Models\Weather;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class UpdateWeatherData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
die('csdc');
//        $latestWeather = Weather::latest()->first();
//
//        // Проверяем, были ли данные о погоде обновлены сегодня
//        if ($latestWeather && $latestWeather->created_at->isToday()) {
//            // Если да, то нет необходимости обновлять данные
//            logger()->info('Weather data is already up to date.');
//            return;
//        }
//
//        // Здесь будет ваш код для запроса к API и обновления данных о погоде
//        // Пример запроса к API OpenWeatherMap
//        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
//            'lat' => 'YOUR_LATITUDE',
//            'lon' => 'YOUR_LONGITUDE',
//            'appid' => 'YOUR_API_KEY',
//            'units' => 'metric', // Метрические единицы
//        ]);
//
//        // Проверяем, успешно ли выполнен запрос
//        if ($response->successful()) {
//            // Получаем данные о погоде из ответа
//            $weatherData = $response->json();
//
//            // Создаем новую запись в базе данных для хранения данных о погоде
//            Weather::create([
//                'temperature' => $weatherData['main']['temp'],
//                'humidity' => $weatherData['main']['humidity'],
//                'wind_speed' => $weatherData['wind']['speed'],
//                'pressure' => $weatherData['main']['pressure'],
//                'description' => $weatherData['weather'][0]['description'],
//                'icon' => $weatherData['weather'][0]['icon'],
//            ]);
//        } else {
//            // Если запрос не удался, обработайте ошибку соответствующим образом
//            // Например, можно записать ошибку в лог или отправить уведомление об ошибке
//            logger()->error('Failed to fetch weather data: ' . $response->status());
//        }
    }
}
