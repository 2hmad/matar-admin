<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutlooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlooks', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->timestamp('date');
            $table->text('country');
            $table->longText('details')->nullable();
            $table->timestamp('schedule')->nullable();
            $table->timestamp('hide')->nullable();
            $table->unsignedInteger('likes')->nullable();
            $table->unsignedInteger('shares')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outlooks');
    }
}
