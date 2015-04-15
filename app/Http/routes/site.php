<?php


Route::get('/', [
    'as'   => 'home',
    'uses' => 'HomeController@index',
]);

// User authentication

Route::get('login', [
    'as' => 'account.login',
    'uses' => 'SessionsController@index'
]);
Route::post('login', 'SessionsController@doLogin');
Route::get('logout', [
    'as' => 'account.logout',
    'uses' => 'SessionsController@logout'
]);

// User registration
Route::get('register', [
    'as' => 'account.register',
    'uses' => 'RegistrationController@create'
]);
Route::post('register', 'RegistrationController@store');
Route::get('confirm/{user}/{token}', [
    'as'   => 'account.register.confirm',
    'uses' => 'RegistrationController@confirm'
]);

// Password reset
Route::get('password-reset', [
    'as' => 'account.password-reset',
    'uses' => 'RemindersController@reminder'
]);
Route::post('password-reset', 'RemindersController@doReminder');

// New password confirm
Route::get('password-reset/confirm/{user}/{token}', [
    'as' => 'account.password-reset.confirm',
    'uses' => 'RemindersController@confirm'
]);

// Download
Route::get('download', [
    'as' => 'download',
    'uses' => 'HomeController@download'
]);

// Highscore

Route::get('highscore/players', [
    'as' => 'highscore.players',
    'uses' => 'HighscoreController@players'
]);

Route::post('highscore/players', [
    'as' => 'highscore.players',
    'uses' => 'HighscoreController@searchPlayer'
]);

Route::get('highscore/guilds', [
    'as' => 'highscore.guilds',
    'uses' => 'HighscoreController@guilds'
]);

Route::post('highscore/guilds', [
    'as' => 'highscore.guilds',
    'uses' => 'HighscoreController@searchGuild'
]);
// Account panel

Route::group(['prefix' => 'account', 'middleware' => 'auth'], function ()
{
    Route::get('/', [
        'as' => 'account.index',
        'uses' => 'AccountController@index'
    ]);
    Route::get('email', [
        'as' => 'account.email',
        'uses' => 'AccountController@email'
    ]);
    Route::post('email', ['uses' => 'AccountController@doEmail']);

    Route::get('password', [
        'as' => 'account.password',
        'uses' => 'AccountController@password'
    ]);
    Route::post('password', ['uses' => 'AccountController@doPassword']);
    Route::get('safebox', [
        'as' => 'account.safebox',
        'uses' => 'AccountController@safebox'
    ]);
    Route::post('safebox', ['uses' => 'AccountController@doSafebox']);

    Route::get('deletion_code', [
        'as' => 'account.deletion_code',
        'uses' => 'AccountController@delCode'
    ]);
    Route::post('deletion_code', ['uses' => 'AccountController@doDelCode']);

    Route::get('characters', [
        'as' => 'account.characters',
        'uses' => 'AccountController@characters'
    ]);
});