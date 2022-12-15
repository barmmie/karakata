<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReportsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->text('message');
            $table->boolean('read_status');
            $table->string('ip_address');
            $table->index('item_id');

            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');

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
        Schema::drop('reports');
    }

}
