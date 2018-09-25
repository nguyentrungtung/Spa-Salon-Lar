<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompleteAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('complete_appointments')){
        Schema::create('complete_appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name');
            $table->string('service_name');
            $table->string('employee_name');
            $table->string('appointment_date');
            $table->string('appointment_time');
            $table->string('payment_status');
            $table->string('internal_note');
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
        Schema::dropIfExists('complete_appointments');
    }
}
