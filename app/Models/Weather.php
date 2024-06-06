<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'description',
        'temperature',
        'humidity',
        'wind_speed',
        'pressure',
        'icon',
    ];
}
