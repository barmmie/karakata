<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('password');
            $table->integer('role');
            $table->integer('status');
            $table->boolean('verified')->defaults(false);
            $table->string('last_ip_address');
            $table->string('confirmation_token');
            $table->index('email');
            $table->index('phone');
            $table->index('full_name');
            $table->rememberToken();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }

}
