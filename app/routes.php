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

// User authentication

Route::get('login', array(
    'as' => 'account.login',
    'uses' => 'SessionsController@index'
));
Route::post('login', 'SessionsController@doLogin');
Route::get('logout', array(
    'as' => 'account.logout',
    'uses' => 'SessionsController@logout'
));

// User registration
Route::get('register', array(
    'as' => 'account.register',
    'uses' => 'RegistrationController@create'
));
Route::post('register', 'RegistrationController@store');
Route::get('confirm/{user}/{token}', array(
    'as'   => 'account.register.confirm',
    'uses' => 'RegistrationController@confirm'
));

// Password reset
Route::get('password-reset', array(
    'as' => 'account.password-reset',
    'uses' => 'RemindersController@reminder'
));
Route::post('password-reset', 'RemindersController@doReminder');

// New password confirm
Route::get('password-reset/confirm/{token}', array(
    'as' => 'account.password-reset.confirm',
    'uses' => 'RemindersController@confirm'
));

// Download
Route::get('download', array(
    'as' => 'download',
    'uses' => 'HomeController@download'
));

// Account panel

Route::group(array('prefix' => 'account'), function ()
{
    Route::get('/', array(
        'as' => 'account.index',
        'uses' => 'AccountController@index'
    ));
    Route::get('email', array(
        'as' => 'account.email',
        'uses' => 'AccountController@email'
    ));
    Route::post('email', array('uses' => 'AccountController@doEmail'));
    
    Route::get('password', array(
        'as' => 'account.password',
        'uses' => 'AccountController@password'
    ));
    Route::post('password', array('uses' => 'AccountController@doPassword'));
    Route::get('safebox', array(
        'as' => 'account.safebox',
        'uses' => 'AccountController@safebox'
    ));
    Route::post('safebox', array('uses' => 'AccountController@doSafebox'));

    Route::get('characters', array(
        'as' => 'account.characters',
        'uses' => 'AccountController@characters'
    ));
});

// Include api routes

require __DIR__ . '/routes/api.php';