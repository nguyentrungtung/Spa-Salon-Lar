<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('payments')){
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('appointment_id');
            $table->boolean('status');
            $table->dateTime('payment_date');
            $table->string('payment_ref');
            $table->integer('user_id');
            $table->string('amount');
            $table->timestamps();
        });
    }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
