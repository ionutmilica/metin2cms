<?php

Route::group(array('namespace' => 'Metin2CMS\Admin\Controllers', 'prefix' => 'admin', 'before' => 'admin.auth'), function()
{
    Route::get('/', array(
        'as'   => 'admin.home',
        'uses' => 'HomeController@index'
    ));

    Route::get('logout', array(
        'as'   => 'admin.logout',
        'uses' => 'HomeController@logout'
    ));
});
