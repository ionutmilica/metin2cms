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

Route::get('/', array(
    'as'   => 'home',
    'uses' => 'HomeController@index',
));


Route::group(array('prefix' => 'account'), function ()
{
    Route::get('index', array('as' => 'account.index', 'uses' => 'AccountController@index'));

    // Auth user
    Route::get('login', array('as' => 'account.login', 'uses' => 'SessionsController@index'));
    Route::post('login', 'SessionsController@doLogin');

    Route::get('logout', array('as' => 'account.logout', 'uses' => 'SessionsController@logout'));

    // Create user
    Route::get('register', array('as' => 'account.create', 'uses' => 'RegistrationController@create'));
    Route::post('register', 'RegistrationController@store');

    // Password Reset
    Route::get('password/reset', array(
        'as' => 'account.recover',
        'uses' => 'RemindersController@reminder'
    ));
    Route::post('password/reset', 'RemindersController@doReminder');

    // New password confirm
    Route::get('password/confirm/{token}', array(
        'as' => 'account.reminder',
        'uses' => 'RemindersController@confirm'
    ));


    // User account confirmation

    Route::get('confirm/{user}/{token}', array(
        'as'   => 'account.confirm',
        'uses' => 'RegistrationController@confirm'
    ));

    // User actions
});