<?php

Route::group(array('prefix' => 'api/v1', 'namespace' => 'Metin2CMS\Api\Controllers'), function()
{
    Route::get('/', function ()
    {
        return array('Metin2CMS Api V1.0.0 !');
    });

    Route::group(array('prefix' => 'highscore'), function()
    {
        Route::get('players', 'HighScoreController@players');
        Route::get('guilds', 'HighScoreController@guilds');
    });

    Route::group(array('namespace' => 'Admin', 'prefix' => 'admin', 'before' => 'admin.auth'), function ()
    {
        Route::group(array('prefix' => 'accounts'), function ()
        {
            Route::get('/', 'AccountController@all');
        });
    });
});