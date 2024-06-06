<?php

namespace App\Console\Commands;

use App\Models\Weather;
use Illuminate\Console\Command;
//use App\Jobs\UpdateWeatherData;
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
//        dispatch(new UpdateWeatherData());
//die('csdcscd');
//        logger()->info('Starting weather update...');

        $latestWeather = Weather::latest()->first();

//
        // Проверяем, были ли данные о погоде обновлены сегодня @TODO Tested
        if ($latestWeather && $latestWeather->created_at->isToday()) {
            // Если да, то нет необходимости обновлять данные
            logger()->info('Weather data is already up to date.');
            return;
        }







//        $start = now()->startOfDay()->toIso8601ZuluString();
//        $end = now()->endOfDay()->toIso8601ZuluString();
//
//
//        // Tru Params
//        $response = Http::withHeaders([
//            'Authorization' => 'b033086e-23fa-11ef-a49b-0242ac130004-b0330a08-23fa-11ef-a49b-0242ac130004'
//        ])->get('https://api.stormglass.io/v2/weather/point', [
//            'lat' => '50.4501', // Широта для Киева
//            'lng' => '30.5234', // Долгота для Киева
//            'params' => implode(',', ['airTemperature', 'humidity', 'pressure', 'windSpeed', 'windDirection']),
//            'start' => $start,
//            'end' => $end,
//        ]);
//
//// Проверяем, успешно ли выполнен запрос
//        if ($response->successful()) {
//            // Получаем данные о погоде из ответа
//            $weatherData = $response->json();
//
//            // Записываем данные погоды в лог
//            logger()->info('Weather data: ' . json_encode($weatherData));
//        } else {
//            // Если запрос не удался, обработайте ошибку соответствующим образом
//            // Например, можно записать ошибку в лог или отправить уведомление об ошибке
//            logger()->error('Failed to fetch weather data: ' . $response->status());
//        }


        $weatherData = '{"hours":[{"airTemperature":{"noaa":15.91,"sg":15.91},"humidity":{"noaa":87.4,"sg":87.4},"pressure":{"noaa":1010.79,"sg":1010.79},"time":"2024-06-06T00:00:00+00:00","windDirection":{"noaa":258.02,"sg":258.02},"windSpeed":{"noaa":4.21,"sg":4.21}},{"airTemperature":{"noaa":15.82,"sg":15.82},"humidity":{"noaa":87,"sg":87},"pressure":{"noaa":1010.71,"sg":1010.71},"time":"2024-06-06T01:00:00+00:00","windDirection":{"noaa":261.82,"sg":261.82},"windSpeed":{"noaa":4.26,"sg":4.26}},{"airTemperature":{"noaa":15.72,"sg":15.72},"humidity":{"noaa":86.6,"sg":86.6},"pressure":{"noaa":1010.64,"sg":1010.64},"time":"2024-06-06T02:00:00+00:00","windDirection":{"noaa":265.61,"sg":265.61},"windSpeed":{"noaa":4.3,"sg":4.3}},{"airTemperature":{"noaa":15.63,"sg":15.63},"humidity":{"noaa":86.2,"sg":86.2},"pressure":{"noaa":1010.56,"sg":1010.56},"time":"2024-06-06T03:00:00+00:00","windDirection":{"noaa":269.41,"sg":269.41},"windSpeed":{"noaa":4.35,"sg":4.35}},{"airTemperature":{"noaa":17.02,"sg":17.02},"humidity":{"noaa":80.73,"sg":80.73},"pressure":{"noaa":1010.87,"sg":1010.87},"time":"2024-06-06T04:00:00+00:00","windDirection":{"noaa":275.5,"sg":275.5},"windSpeed":{"noaa":4.71,"sg":4.71}},{"airTemperature":{"noaa":18.41,"sg":18.41},"humidity":{"noaa":75.27,"sg":75.27},"pressure":{"noaa":1011.18,"sg":1011.18},"time":"2024-06-06T05:00:00+00:00","windDirection":{"noaa":281.58,"sg":281.58},"windSpeed":{"noaa":5.06,"sg":5.06}},{"airTemperature":{"noaa":19.8,"sg":19.8},"humidity":{"noaa":69.8,"sg":69.8},"pressure":{"noaa":1011.49,"sg":1011.49},"time":"2024-06-06T06:00:00+00:00","windDirection":{"noaa":287.67,"sg":287.67},"windSpeed":{"noaa":5.42,"sg":5.42}},{"airTemperature":{"noaa":20.9,"sg":20.9},"humidity":{"noaa":66.33,"sg":66.33},"pressure":{"noaa":1011.85,"sg":1011.85},"time":"2024-06-06T07:00:00+00:00","windDirection":{"noaa":291.19,"sg":291.19},"windSpeed":{"noaa":5.53,"sg":5.53}},{"airTemperature":{"noaa":22,"sg":22},"humidity":{"noaa":62.87,"sg":62.87},"pressure":{"noaa":1012.21,"sg":1012.21},"time":"2024-06-06T08:00:00+00:00","windDirection":{"noaa":294.7,"sg":294.7},"windSpeed":{"noaa":5.63,"sg":5.63}},{"airTemperature":{"noaa":23.1,"sg":23.1},"humidity":{"noaa":59.4,"sg":59.4},"pressure":{"noaa":1012.57,"sg":1012.57},"time":"2024-06-06T09:00:00+00:00","windDirection":{"noaa":298.22,"sg":298.22},"windSpeed":{"noaa":5.74,"sg":5.74}},{"airTemperature":{"noaa":23.33,"sg":23.33},"humidity":{"noaa":57.7,"sg":57.7},"pressure":{"noaa":1012.78,"sg":1012.78},"time":"2024-06-06T10:00:00+00:00","windDirection":{"noaa":293.29,"sg":293.29},"windSpeed":{"noaa":5.53,"sg":5.53}},{"airTemperature":{"noaa":23.56,"sg":23.56},"humidity":{"noaa":56,"sg":56},"pressure":{"noaa":1012.99,"sg":1012.99},"time":"2024-06-06T11:00:00+00:00","windDirection":{"noaa":288.35,"sg":288.35},"windSpeed":{"noaa":5.33,"sg":5.33}},{"airTemperature":{"noaa":23.79,"sg":23.79},"humidity":{"noaa":54.3,"sg":54.3},"pressure":{"noaa":1013.2,"sg":1013.2},"time":"2024-06-06T12:00:00+00:00","windDirection":{"noaa":283.42,"sg":283.42},"windSpeed":{"noaa":5.12,"sg":5.12}},{"airTemperature":{"noaa":24.48,"sg":24.48},"humidity":{"noaa":50.53,"sg":50.53},"pressure":{"noaa":1013.04,"sg":1013.04},"time":"2024-06-06T13:00:00+00:00","windDirection":{"noaa":289.32,"sg":289.32},"windSpeed":{"noaa":4.97,"sg":4.97}},{"airTemperature":{"noaa":25.16,"sg":25.16},"humidity":{"noaa":46.77,"sg":46.77},"pressure":{"noaa":1012.89,"sg":1012.89},"time":"2024-06-06T14:00:00+00:00","windDirection":{"noaa":295.21,"sg":295.21},"windSpeed":{"noaa":4.81,"sg":4.81}},{"airTemperature":{"noaa":25.84,"sg":25.84},"humidity":{"noaa":43,"sg":43},"pressure":{"noaa":1012.73,"sg":1012.73},"time":"2024-06-06T15:00:00+00:00","windDirection":{"noaa":301.11,"sg":301.11},"windSpeed":{"noaa":4.66,"sg":4.66}},{"airTemperature":{"noaa":24.41,"sg":24.41},"humidity":{"noaa":49.5,"sg":49.5},"pressure":{"noaa":1013.23,"sg":1013.23},"time":"2024-06-06T16:00:00+00:00","windDirection":{"noaa":307.05,"sg":307.05},"windSpeed":{"noaa":4.07,"sg":4.07}},{"airTemperature":{"noaa":22.97,"sg":22.97},"humidity":{"noaa":56,"sg":56},"pressure":{"noaa":1013.72,"sg":1013.72},"time":"2024-06-06T17:00:00+00:00","windDirection":{"noaa":313,"sg":313},"windSpeed":{"noaa":3.49,"sg":3.49}},{"airTemperature":{"noaa":21.54,"sg":21.54},"humidity":{"noaa":62.5,"sg":62.5},"pressure":{"noaa":1014.22,"sg":1014.22},"time":"2024-06-06T18:00:00+00:00","windDirection":{"noaa":318.94,"sg":318.94},"windSpeed":{"noaa":2.9,"sg":2.9}},{"airTemperature":{"noaa":20.46,"sg":20.46},"humidity":{"noaa":68.03,"sg":68.03},"pressure":{"noaa":1014.67,"sg":1014.67},"time":"2024-06-06T19:00:00+00:00","windDirection":{"noaa":313.02,"sg":313.02},"windSpeed":{"noaa":2.79,"sg":2.79}},{"airTemperature":{"noaa":19.38,"sg":19.38},"humidity":{"noaa":73.57,"sg":73.57},"pressure":{"noaa":1015.13,"sg":1015.13},"time":"2024-06-06T20:00:00+00:00","windDirection":{"noaa":307.1,"sg":307.1},"windSpeed":{"noaa":2.67,"sg":2.67}},{"airTemperature":{"noaa":18.3,"sg":18.3},"humidity":{"noaa":79.1,"sg":79.1},"pressure":{"noaa":1015.58,"sg":1015.58},"time":"2024-06-06T21:00:00+00:00","windDirection":{"noaa":301.18,"sg":301.18},"windSpeed":{"noaa":2.56,"sg":2.56}},{"airTemperature":{"noaa":17.83,"sg":17.83},"humidity":{"noaa":81.5,"sg":81.5},"pressure":{"noaa":1015.92,"sg":1015.92},"time":"2024-06-06T22:00:00+00:00","windDirection":{"noaa":302.49,"sg":302.49},"windSpeed":{"noaa":2.74,"sg":2.74}},{"airTemperature":{"noaa":17.35,"sg":17.35},"humidity":{"noaa":83.9,"sg":83.9},"pressure":{"noaa":1016.26,"sg":1016.26},"time":"2024-06-06T23:00:00+00:00","windDirection":{"noaa":303.79,"sg":303.79},"windSpeed":{"noaa":2.92,"sg":2.92}}],"meta":{"cost":1,"dailyQuota":10,"end":"2024-06-06 23:59","lat":50.4501,"lng":30.5234,"params":["airTemperature","humidity","pressure","windSpeed","windDirection"],"requestCount":2,"start":"2024-06-06 00:00"}}';

        $weatherData = json_decode($weatherData, true);
        print_r($weatherData);die();













//        $response = Http::get('https://api.stormglass.io/v2/weather/point', [
//            'lat' => '50.4501',
//            'lng' => '30.5234',
//            'params' => 'waveHeight,airTemperature',
//            'start' => now()->startOfDay()->toIso8601String(), // Начало текущего дня
//            'end' => now()->endOfDay()->toIso8601String(), // Конец текущего дня
//        ])->withHeaders([
//            'Authorization' => 'Bearer b033086e-23fa-11ef-a49b-0242ac130004-b0330a08-23fa-11ef-a49b-0242ac130004', // Замените YOUR_API_KEY на ваш API ключ
//        ]);
//
//
//
//        // Проверяем, успешно ли выполнен запрос
//        if ($response->successful()) {
//            // Получаем данные о погоде из ответа
//            $weatherData = $response->json();
//
//            // Записываем данные погоды в лог
//            logger()->info('Weather data: ' . $weatherData);
//        } else {
//            // Если запрос не удался, обработайте ошибку соответствующим образом
//            // Например, можно записать ошибку в лог или отправить уведомление об ошибке
//            logger()->error('Failed to fetch weather data: ' . $response->status());
//        }

















//
//        // Здесь будет ваш код для запроса к API и обновления данных о погоде
//        // Пример запроса к API OpenWeatherMap
//        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
//            'lat' => '50.4501',
//            'lon' => '30.5234',
//            'appid' => 'b033086e-23fa-11ef-a49b-0242ac130004-b0330a08-23fa-11ef-a49b-0242ac130004',
//            'units' => 'metric', // Метрические единицы
//        ]);
//
        // Проверяем, успешно ли выполнен запрос
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
//
//            echo 'success';
//        } else {
//            // Если запрос не удался, обработайте ошибку соответствующим образом
//            // Например, можно записать ошибку в лог или отправить уведомление об ошибке
//            logger()->error('Failed to fetch weather data: ' . $response->status());
//        }
    }
}
