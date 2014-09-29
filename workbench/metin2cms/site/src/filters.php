<?php

/**
 * Handle all form validation errors and resend user to the original form
 */
/*
App::error(function (\Metin2Cms\Site\Validation\FormValidationException $e)
{
    return Redirect::back()->withInput()->withErrors($e->getErrors());
});*/