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

    Route::group(array('prefix' => 'account'), function ()
    {
        Route::get('/', array(
            'as'    => 'admin.account.index',
            'uses'  => 'AccountController@index'
        ));
    });
});
