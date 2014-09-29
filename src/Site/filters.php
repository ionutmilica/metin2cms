<?php

App::error(function (\Metin2CMS\Site\Validation\FormValidationException $e)
{
    return Redirect::back()->withInput()->withErrors($e->getErrors());
});