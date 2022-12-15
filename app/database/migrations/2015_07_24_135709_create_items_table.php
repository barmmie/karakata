<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->string('slug');
            $table->enum('type', ['business', 'personal']);
            $table->string('amount');
            $table->string('email');
            $table->string('phone');
            $table->string('seller_name');
            $table->integer('location_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('status');
            $table->string('ip_address');
            $table->timestamp('premium_until')->nullable();
            $table->boolean('negotiable')->default(true);

            $table->index('slug');
            $table->index('location_id');
            $table->index('category_id');
            $table->index('user_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::drop('items');
    }

}
