<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayoutSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payout_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('marketer_id');
            $table->text('method');
            $table->text('paypal_account')->nullable();
            $table->text('bank_name')->nullable();
            $table->text('bank_account')->nullable();
            $table->text('bank_account_number')->nullable();
            $table->text('bank_swift')->nullable();
            $table->text('full_name')->nullable();
            $table->text('id_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payout_settings');
    }
}
