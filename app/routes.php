<?php

Route::get('/', ['as' => 'pages.homepage', 'uses' => 'PageController@homepage']);

Route::group(['before' => 'guest'], function () {

    Route::get('login', ['as' => 'users.login', 'uses' => 'SessionsController@create']);

    Route::post('login', ['as' => 'sessions.store', 'uses' => 'SessionsController@store']);

    Route::get('register', ['as' => 'users.register', 'uses' => 'UsersController@create']);

});

Route::controller('password', 'RemindersController');

Route::get('logout', ['as' => 'sessions.destroy', 'uses' => 'SessionsController@destroy']);
Route::get('about', ['as' => 'pages.about', 'uses' => 'PageController@about']);
Route::get('terms-conditions', ['as' => 'pages.terms_conditions', 'uses' => 'PageController@termsConditions']);
Route::get('privacy-policy', ['as' => 'pages.privacy_policy', 'uses' => 'PageController@privacyPolicy']);
Route::get('faq', ['as' => 'pages.faq', 'uses' => 'PageController@faq']);
Route::get('sitemap.xml', ['as' => 'pages.sitemap', 'uses' => 'PageController@sitemap']);

Route::get('categories/{category}/{sub_category?}', ['as' => 'categories.show', 'uses' => 'CategoriesController@show']);

Route::get('items/search', ['as' => 'items.search', 'uses' => 'ItemsController@search']);
Route::get('items/search', ['as' => 'pages.terms', 'uses' => 'ItemsController@search']);

Route::get('register/confirm/{token}', ['as' => 'users.confirm', 'uses' => 'UsersController@confirm']);

Route::get('users/{id}/items', ['as' => 'users.items', 'uses' => 'UsersController@show']);
Route::get('users/{id}/reviews', ['as' => 'users.reviews', 'uses' => 'UsersController@reviews']);
Route::post('users/{id}/reviews', ['as' => 'users.post_review', 'uses' => 'UsersController@postReviews']);

Route::resource('users', 'UsersController');

Route::post('messages', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
Route::post('reports', ['as' => 'reports.store', 'uses' => 'ReportsController@store']);

Route::group(['before' => 'auth'], function () {


    Route::get('items/new', ['as' => 'items.new', 'uses' => 'ItemsController@create']);

    Route::post('items/new', ['as' => 'items.store', 'uses' => 'ItemsController@store']);

    Route::get('items/{id}/edit', ['as' => 'items.edit', 'uses' => 'ItemsController@edit']);
    Route::get('items/{id}/delete', ['as' => 'items.delete', 'uses' => 'ItemsController@delete']);
    Route::get('items/{id}/payment', ['as' => 'items.payment', 'uses' => 'PaymentController@displayItemReceipt']);
    Route::post('items/{id}/payment', ['as' => 'items.post_payment', 'uses' => 'PaymentController@postPayment']);
    Route::get('items/{id}/stripe_form', ['as' => 'items.stripe_form', 'uses' => 'PaymentController@showStripeForm']);
    Route::get('items/{id}/stripe_existing', ['as' => 'items.stripe_existing', 'uses' => 'PaymentController@processExistingStripePayment']);
    Route::post('items/{id}/stripe_form', ['as' => 'items.process_stripe_form', 'uses' => 'PaymentController@processStripeForm']);

    Route::get('items/{id}/payment_success', ['as' => 'payments.success', 'uses' => 'PaymentController@success']);
    Route::get('items/{id}/payment_cancel', ['as' => 'payments.cancel', 'uses' => 'PaymentController@cancel']);

    Route::get('items/{id}/favorite', ['as' => 'items.favorite', 'uses' => 'ItemsController@favorite']);

    Route::get('items/{id}/unfavorite', ['as' => 'items.unfavorite', 'uses' => 'ItemsController@unfavorite']);

    Route::post('items/{id}', ['as' => 'items.update', 'uses' => 'ItemsController@update']);

    Route::get('myitems', ['as' => 'dash.myitems', 'uses' => 'DashController@myitems']);

    Route::get('myitems/favorites', ['as' => 'dash.myfavorites', 'uses' => 'DashController@myfavorites']);
    Route::get('mymessages/{read_status?}', ['as' => 'dash.mymessages', 'uses' => 'DashController@mymessages']);

    Route::get('profile', ['as' => 'users.profile', 'uses' => 'UsersController@edit']);

    Route::post('profile', ['as' => 'users.update_profile', 'uses' => 'UsersController@update']);

    Route::post('password', ['as' => 'users.update_password', 'uses' => 'UsersController@updatePassword']);

    Route::post('pictures/store', ['as' => 'pictures.store', 'uses' => 'PicturesController@store']);
    Route::post('pictures/uploadLogo', ['as' => 'pictures.uploadLogo', 'uses' => 'PicturesController@uploadLogo']);
    Route::delete('pictures', ['as' => 'pictures.destroy', 'uses' => 'PicturesController@destroy']);

});

Route::get('items/{item_slug}', ['as' => 'items.show', 'uses' => 'ItemsController@show']);

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'before' => 'auth|admin'], function () {

    Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => 'DashController@dashboard']);
    Route::get('dashboard/itemsByYear', ['as' => 'admin.items_by_year', 'uses' => 'DashController@itemsByYear']);
    Route::get('dashboard/itemsByLocation', ['as' => 'admin.items_by_location', 'uses' => 'DashController@itemsByLocation']);

    Route::get('users/{id}/verify', ['as' => 'admin.users.verify', 'uses' => 'UsersController@verify']);
    Route::post('admins', ['as' => 'admin.create', 'uses' => 'UsersController@storeAdmin']);
    Route::get('users/{id}/items', ['as' => 'admin.users.items', 'uses' => 'UsersController@items']);
    Route::get('users/{id}/ban', ['as' => 'admin.users.ban', 'uses' => 'UsersController@ban']);
    Route::get('users/{id}/activate', ['as' => 'admin.users.activate', 'uses' => 'UsersController@activate']);
    Route::get('users/{status?}', ['as' => 'admin.users.index', 'uses' => 'UsersController@index']);

    Route::get('items/{status?}', ['as' => 'admin.items.index', 'uses' => 'ItemsController@index']);
    Route::get('items/{id}/show', ['as' => 'admin.items.show', 'uses' => 'ItemsController@show']);
    Route::get('items/{id}/edit', ['as' => 'admin.items.edit', 'uses' => 'ItemsController@edit']);
    Route::post('items/{id}/update', ['as' => 'admin.items.update', 'uses' => 'ItemsController@update']);
    Route::get('items/{id}/approve', ['as' => 'admin.items.approve', 'uses' => 'ItemsController@approve']);
    Route::get('items/{id}/reject', ['as' => 'admin.items.reject', 'uses' => 'ItemsController@reject']);
    Route::get('items/{id}/delete', ['as' => 'admin.items.delete', 'uses' => 'ItemsController@delete']);
    Route::get('items/{id}/markPremium', ['as' => 'admin.items.mark_premium', 'uses' => 'ItemsController@markPremium']);
    Route::get('reports/{id}/delete', ['as' => 'admin.reports.delete', 'uses' => 'ReportsController@delete']);
    Route::get('reports/{id}/reviewed',
        ['as' => 'admin.reports.reviewed', 'uses' => 'ReportsController@markAsReviewed']);
    Route::get('reports/{id}/unreviewed',
        ['as' => 'admin.reports.unreviewed', 'uses' => 'ReportsController@markAsUnreviewed']);

    Route::get('reports/{status?}', ['as' => 'admin.reports.index', 'uses' => 'ReportsController@index']);

    Route::get('settings', ['as' => 'settings.edit', 'uses' => 'SettingsController@edit']);

    Route::post('settings', ['as' => 'settings.update', 'uses' => 'SettingsController@update']);

    Route::resource('locations', 'LocationsController');

    Route::controller("categories", 'CategoriesController');

});

Route::get('404', ['as' => 'pages.404', 'uses' => 'PageController@page404']);
Route::get('500', ['as' => 'pages.500', 'uses' => 'PageController@page500']);
Route::get('install', ['as' => 'installers.create', 'uses' => 'AppController@install']);
Route::get('update', ['as' => 'installers.update', 'uses' => 'AppController@update']);
Route::post('install', ['as' => 'installers.store', 'uses' => 'AppController@store']);

Route::get('switch_language/{lang?}', ['as' => 'language_switcher', 'uses' => 'PageController@switch_language']);
Route::get('feed/{type?}', ['as' => 'pages.feed', 'uses' => 'PageController@feed']);

Route::get('social/facebook', ['as' => 'social.facebook', 'uses' => 'SocialAuthController@loginWithFacebook']);
Route::get('social/google', ['as' => 'social.google', 'uses' => 'SocialAuthController@loginWithGoogle']);

Route::get('test', function(){
    $item = Item::find(2);
    dd(phpinfo());
});

