<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutlooksCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlooks_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('outlook_id');
            $table->unsignedInteger('user_id');
            $table->text('comment');
            $table->text('reply')->nullable();
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
        Schema::dropIfExists('outlooks_comments');
    }
}
