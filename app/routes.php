<?php

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


Route::get('/', 'HomeController@index');


Route::group(array('prefix' => 'account'), function ()
{
    // Auth user
    Route::get('auth', 'AccountController@auth');
    Route::post('auth', 'AccountController@doAuth');

    // Create user
    Route::get('create', 'AccountController@create');
    Route::get('create', 'AccountController@doCreate');

    // User actions
});