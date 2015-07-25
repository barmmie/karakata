<?php

use Kalnoy\Nestedset\NestedSet;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['as' => 'pages.homepage', 'uses' => 'PageController@homepage']);


Route::group(['before'=> 'guest'], function(){

    Route::get('login', ['as' => 'users.login', 'uses' => 'SessionsController@create']);

    Route::post('login', ['as' => 'sessions.store', 'uses' => 'SessionsController@store']);

    Route::get('register', ['as' =>'users.register', 'uses' => 'UsersController@create']);


});

Route::group(['before'=> 'auth'], function(){



    Route::get('logout', ['as' => 'sessions.destroy', 'uses' => 'SessionsController@destroy']);

    Route::get('items/new', ['as' => 'items.new', 'uses' => 'ItemsController@create']);
    Route::post('items/new', ['as' => 'items.store', 'uses' => 'ItemsController@store']);

    Route::get('myitems', ['as' => 'dash.items', 'uses' => 'DashController@myitems']);


});




Route::get('terms-condition', ['as' => 'pages.terms', 'uses' => 'SessionsController@create']);


Route::get('register/confirm/{token}', ['as' => 'users.confirm', 'uses' => 'UsersController@confirm']);

Route::resource('users', 'UsersController');


Route::group(['namespace' => 'Admin', 'prefix'=> 'admin'], function(){
    Route::resource('locations', 'LocationsController');
    Route::controller("categories", 'CategoriesController');
});

Route::get('test', function(){

});












