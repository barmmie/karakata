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

Route::get('categories/{category}/{sub_category?}', ['as' => 'categories.show', 'uses' => 'CategoriesController@show']);




Route::get('items/search', ['as' => 'items.search', 'uses' => 'ItemsController@search']);

Route::get('terms-condition', ['as' => 'pages.terms', 'uses' => 'SessionsController@create']);


Route::get('register/confirm/{token}', ['as' => 'users.confirm', 'uses' => 'UsersController@confirm']);

Route::get('users/{id}/items', ['as' => 'users.items', 'uses' => 'UsersController@show']);

Route::resource('users', 'UsersController');

Route::group(['before'=> 'auth'], function(){


    Route::get('logout', ['as' => 'sessions.destroy', 'uses' => 'SessionsController@destroy']);

    Route::get('items/new', ['as' => 'items.new', 'uses' => 'ItemsController@create']);
    Route::post('items/new', ['as' => 'items.store', 'uses' => 'ItemsController@store']);
    Route::get('items/{id}/edit', ['as' => 'items.edit', 'uses' => 'ItemsController@edit']);
    Route::get('items/{id}/favorite', ['as' => 'items.favorite', 'uses' => 'ItemsController@favorite']);
    Route::get('items/{id}/unfavorite', ['as' => 'items.unfavorite', 'uses' => 'ItemsController@unfavorite']);
    Route::post('items/{id}', ['as' => 'items.update', 'uses' => 'ItemsController@update']);

    Route::get('myitems', ['as' => 'dash.myitems', 'uses' => 'DashController@myitems']);
    Route::get('myitems/favorites', ['as' => 'dash.myfavorites', 'uses' => 'DashController@myfavorites']);


    Route::get('profile', ['as' => 'users.profile', 'uses' => 'UsersController@edit']);
    Route::post('profile', ['as' => 'users.update_profile', 'uses' => 'UsersController@update']);
    Route::post('password', ['as' => 'users.update_password', 'uses' => 'UsersController@updatePassword']);

    Route::post('pictures/store', ['as' => 'pictures.store', 'uses' => 'PicturesController@store']);

});

Route::get('items/{item_slug}', ['as' => 'items.show', 'uses' => 'ItemsController@show']);

Route::group(['namespace' => 'Admin', 'prefix'=> 'admin'], function(){
    Route::resource('locations', 'LocationsController');
    Route::controller("categories", 'CategoriesController');
});

Route::get('test', function(){
    $img = Image::make(file_get_contents('http://www.anti.to/wp-content/plugins/ecommerce-product-catalog/img/no-default-thumbnail.png'));

    dd(image_type_to_extension(exif_imagetype('http://www.anti.to/wp-content/plugins/ecommerce-product-catalog/img/no-default-thumbnail.png')));
    var_dump($img);

    return $img->response('jpg', 70);
});














