<?php

use Illuminate\Support\Facades\Redirect;

/**
 * Exceptions.
 */

App::error(function (\Metin2CMS\Core\Validation\FormValidationException $e)
{
    return Redirect::back()->withInput()->withErrors($e->getErrors());
});

App::error(function (\Metin2CMS\Core\Exceptions\AbstractException $e)
{
    $redirect = app('redirect');

    if ($e->getRedirection() == '')
    {
        $redirect = $redirect->back();
    }
    else
    {
        $redirect->route($e->getRedirection());
    }

    return $redirect->withInput()->withErrors(array(
        'global' => $e->getMessage()
    ));
});

/**
 * Maintenance mode custom page
 */

App::down(function()
{
    if (Request::is('admin*'))
    {
        return null;
    }

    return View::make('pages.maintenance');
});
