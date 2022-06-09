<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketers', function (Blueprint $table) {
            $table->id();
            $table->text('coupon');
            $table->text('full_name');
            $table->string('email');
            $table->text('phone')->nullable();
            $table->text('address')->nullable();
            $table->text('country');
            $table->text('password');
            $table->text('coupon_expire')->nullable();
            $table->unsignedFloat('reg_commission')->nullable();
            $table->unsignedFloat('sub_commission')->nullable();
            $table->text('facebook_acc')->nullable();
            $table->text('twitter_acc')->nullable();
            $table->text('instagram_acc')->nullable();
            $table->text('tiktok_acc')->nullable();
            $table->text('token');
            $table->text('pic')->nullable();
            $table->unsignedInteger('ban')->nullable();
            $table->unsignedInteger('active')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marketers');
    }
}
