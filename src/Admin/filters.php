<?php

use Illuminate\Support\Facades\Redirect;

App::error(function (\Metin2CMS\Core\Validation\FormValidationException $e)
{
    return Redirect::back()->withInput()->withErrors($e->getErrors());
});

App::error(function (\Metin2CMS\Core\Exceptions\AbstractException $e)
{
    return Redirect::route($e->getRedirection())->withInput()->withErrors(array(
        'global' => $e->getMessage()
    ));
});

Route::filter('admin.auth', function()
{
    if (Auth::check() || ! Auth::user()->isAdmin())
    {
            return Redirect::route('home');
    }
});