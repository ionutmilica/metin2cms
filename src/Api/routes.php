<?php

Route::group(array('prefix' => 'api/v1', 'namespace' => 'Metin2CMS\Api\Controllers'), function()
{
    Route::get('/', function ()
    {
        return 'Hello to our api !';
    });

    Route::group(array('prefix' => 'highscore'), function()
    {
        Route::get('players', 'HighScoreController@players');
        Route::get('guilds', 'HighScoreController@guilds');
    });
});