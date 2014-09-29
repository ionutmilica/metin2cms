<?php

App::error(function (\Metin2Cms\Site\Validation\FormValidationException $e)
{
    return Redirect::back()->withInput()->withErrors($e->getErrors());
});