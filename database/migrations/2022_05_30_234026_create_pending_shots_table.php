<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendingShotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_shots', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->text('photographer');
            $table->text('location');
            $table->timestamp('send_date')->nullable();
            $table->timestamp('date')->nullable();
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
        Schema::dropIfExists('pending_shots');
    }
}
