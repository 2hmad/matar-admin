<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherShotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_shots', function (Blueprint $table) {
            $table->id();
            $table->text('photographer');
            $table->text('location');
            $table->timestamp('date');
            $table->timestamp('schedule')->nullable();
            $table->timestamp('hide')->nullable();
            $table->unsignedInteger('shares')->nullable();
            $table->text('media');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather_shots');
    }
}
