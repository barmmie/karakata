<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemUserTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id');
            $table->index('item_id');
            $table->integer('user_id');
            $table->index('user_id');
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
        Schema::drop('item_user');
    }

}
