<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddStripeFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('stripe_customer_id')->nullable();
            $table->string('last_four')->nullable();
            $table->string('card_type')->nullable();
            $table->string('expiry_year')->nullable();
            $table->string('expiry_month')->nullable();
            $table->boolean('is_stripe_customer')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users')->dropColumn(['stripe_customer_id','last_four','card_type','expiry_year','expiry_month','is_stripe_customer']);
    }
}
