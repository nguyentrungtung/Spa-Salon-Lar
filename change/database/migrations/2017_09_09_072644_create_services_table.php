<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('services')){
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('employee_id');
            $table->string('name');
            $table->string('service_image');
            $table->boolean('status');
            $table->string('price');
            $table->string('point');
            $table->string('houre');
            $table->string('minute');
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
        Schema::dropIfExists('services');
    }
}
