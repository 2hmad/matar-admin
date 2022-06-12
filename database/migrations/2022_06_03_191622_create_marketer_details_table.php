<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketer_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('marketer_id');
            $table->unsignedInteger('user_id');
            $table->text('name');
            $table->text('email');
            $table->text('country');
            $table->text('type');
            $table->float('amount');
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marketer_details');
    }
}
