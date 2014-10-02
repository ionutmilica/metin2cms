<?php

Route::group(array('prefix' => 'api/v1', 'namespace' => 'Metin2CMS\Core\Controllers'), function()
{
    Route::get('/', function ()
    {
        return 'Hello to our api !';
    });
});