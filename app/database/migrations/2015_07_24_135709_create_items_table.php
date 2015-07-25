<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('items', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->string('slug');
            $table->enum('type',['business','personal']);
            $table->string('amount');
            $table->string('email');
            $table->string('phone');
            $table->string('seller_name');
            $table->integer('location_id');
            $table->integer('category_id');
            $table->integer('user_id');
            $table->integer('status');
            $table->boolean('negotiable')->default(true);
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
