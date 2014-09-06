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
    Route::get('index', array('as' => 'account.index', 'uses' => 'AccountController@index'));

    // Auth user
    Route::get('login', array('as' => 'account.auth', 'uses' => 'AccountController@auth'));
    Route::post('login', 'AccountController@doAuth');

    // Create user
    Route::get('create', array('as' => 'account.create', 'uses' => 'RegistrationController@create'));
    Route::post('create', 'RegistrationController@store');

    // User account confirmation

    Route::get('confirm/{token}', array(
        'as'   => 'account.confirm',
        'uses' => 'RegistrationController@confirm'
    ));

    // User actions
});