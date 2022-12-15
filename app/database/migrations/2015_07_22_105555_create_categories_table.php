<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Kalnoy\Nestedset\NestedSet;

class CreateCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->string('icon')->nullable();

            $table->index('title');
            $table->index('slug');
            $table->timestamps();
            NestedSet::columns($table);


        });

        NestedSet::createRoot('categories', array(
            'title' => 'Root',
	        'slug' => 'root'
        ));
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories');
    }

}
