<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *aa table doc ma joi ne modify kri dejo ok
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('users')){
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->integer('phone');
            $table->string('gender');
            $table->string('device_token');
            $table->string('fb_token');
            $table->integer('fb_id');
            $table->string('profile_image');
            $table->boolean('status');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
