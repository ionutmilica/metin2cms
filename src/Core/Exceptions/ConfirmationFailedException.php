<?php namespace Metin2CMS\Core\Exceptions;

class ConfirmationFailedException extends AbstractException {

    /**
     * @var string
     */
    protected $redirectTo = 'home';
}
