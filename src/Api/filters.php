<?php

/**
 * Catch all errors thrown by the validation
 */ /*
App::error(function (\Metin2CMS\Core\Validation\FormValidationException $e)
{
    return Response::json(['status' => 'error', 'errors' => $e->getErrors()], 422);
}); */

/**
 * Catch all errors thrown by the services
 */ /*
App::error(function (\Metin2CMS\Core\Exceptions\AbstractException $e)
{
    return Response::json(['status' => 'error', 'errors' => $e->getErrors()], $e->getStatus());
}); */