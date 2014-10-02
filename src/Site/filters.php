<?php

use Illuminate\Support\Facades\Redirect;

App::error(function (\Metin2CMS\Site\Validation\FormValidationException $e)
{
    return Redirect::back()->withInput()->withErrors($e->getErrors());
});

App::error(function (\Metin2CMS\Site\Exceptions\AbstractException $e)
{
    return Redirect::route($e->getRedirection())->withInput()->withErrors(array(
        'global' => $e->getMessage()
    ));
});