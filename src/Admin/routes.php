<?php

Route::group(array('namespace' => 'Metin2CMS\Admin\Controllers', 'prefix' => 'admin'), function()
{
    Route::get('/', 'HomeController@index');
});
