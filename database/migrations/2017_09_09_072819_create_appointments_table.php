<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('appointments')){
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('service_id');
            $table->integer('employee_id');
            $table->string('appointment_date');
            $table->string('appointment_time');
            $table->boolean('payment_status');
            $table->boolean('status');
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
        Schema::dropIfExists('appointments');
    }
}
