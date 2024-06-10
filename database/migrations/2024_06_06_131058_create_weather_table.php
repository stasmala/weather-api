<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('weather');

        Schema::create('weather', function (Blueprint $table) {
            $table->id();
            $table->dateTime('time');
            $table->decimal('air_temperature_noaa', 8, 2)->nullable();
            $table->decimal('air_temperature_sg', 8, 2)->nullable();
            $table->decimal('humidity_noaa', 8, 2)->nullable();
            $table->decimal('humidity_sg', 8, 2)->nullable();
            $table->decimal('pressure_noaa', 8, 2)->nullable();
            $table->decimal('pressure_sg', 8, 2)->nullable();
            $table->decimal('wind_direction_noaa', 8, 2)->nullable();
            $table->decimal('wind_direction_sg', 8, 2)->nullable();
            $table->decimal('wind_speed_noaa', 8, 2)->nullable();
            $table->decimal('wind_speed_sg', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather');
    }
};
