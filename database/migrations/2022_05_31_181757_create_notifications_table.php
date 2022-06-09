<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->text('subject');
            $table->text('content');
            $table->timestamp('date')->nullable();
            $table->text('country')->nullable();
            $table->text('appearance_for');
            $table->text('appearance_as');
            $table->text('redirect')->nullable();
            $table->timestamp('schedule')->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
