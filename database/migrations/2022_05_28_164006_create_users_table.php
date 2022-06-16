<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('email');
            $table->string('password');
            $table->text('country')->nullable();
            $table->text('phone')->nullable();
            $table->text('facebook_token')->nullable();
            $table->text('google_token')->nullable();
            $table->text('token');
            $table->text('pic')->nullable();
            $table->text('date')->nullable();
            $table->text('coupon')->nullable();
            $table->unsignedInteger('ban')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
