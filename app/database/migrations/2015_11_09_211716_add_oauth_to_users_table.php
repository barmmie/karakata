<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOauthToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table){
            $table->string('facebook_oauth_id')->nullable();
            $table->string('google_oauth_id')->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('users', function($table)
        {
            $table->dropColumn(array('facebook_oauth_id', 'google_oauth_id'));
        });
	}

}
