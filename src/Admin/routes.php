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

    Route::group(array('prefix' => 'accounts'), function ()
    {
        Route::get('/', array(
            'as'    => 'admin.account.index',
            'uses'  => 'AccountController@index'
        ));
        Route::get('{id}/edit', array(
            'as'    => 'admin.account.edit',
            'uses'  => 'AccountController@editForm'
        ));
        Route::post('{id}/edit', array('uses'  => 'AccountController@doEdit'));
        Route::get('{id}/block', array(
            'as'    => 'admin.account.block',
            'uses'  => 'AccountController@blockForm'
        ));
        Route::post('{id}/block', array('uses'  => 'AccountController@doBlock'));
        Route::get('{id}/unblock', array(
            'as'    => 'admin.account.unblock',
            'uses'  => 'AccountController@doUnBlock'
        ));
        Route::get('{id}/history', array(
            'as'    => 'admin.account.history',
            'uses'  => 'AccountController@history'
        ));
    });

    Route::group(array('prefix' => 'staff'), function ()
    {
        Route::get('/', array(
            'as'   => 'admin.staff.index',
            'uses' => 'StaffController@index'
        ));

        Route::get('create', array(
            'as'   => 'admin.staff.create',
            'uses' => 'StaffController@createForm'
        ));
        Route::post('create', array('uses' => 'StaffController@doCreate'));

        Route::get('{id}/delete', array(
            'as'   => 'admin.staff.delete',
            'uses' => 'StaffController@delete'
        ));
    });

    Route::group(array('prefix' => 'players'), function ()
    {
        Route::get('/', array(
            'as'   => 'admin.player.index',
            'uses' => 'PlayerController@index'
        ));
    });
});
