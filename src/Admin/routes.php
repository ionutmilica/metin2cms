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
        Route::get('/edit/{id}', array(
            'as'    => 'admin.account.edit',
            'uses'  => 'AccountController@editForm'
        ));
        Route::post('/edit/{id}', array('uses'  => 'AccountController@doEdit'));
        Route::get('/block/{id}', array(
            'as'    => 'admin.account.block',
            'uses'  => 'AccountController@blockForm'
        ));
        Route::post('/block/{id}', array('uses'  => 'AccountController@doBlock'));

    });
});
