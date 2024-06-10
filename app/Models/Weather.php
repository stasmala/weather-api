<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'time',
        'air_temperature_noaa',
        'air_temperature_sg',
        'humidity_noaa',
        'humidity_sg',
        'pressure_noaa',
        'pressure_sg',
        'wind_direction_noaa',
        'wind_direction_sg',
        'wind_speed_noaa',
        'wind_speed_sg',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'time' => 'datetime',
    ];
}
