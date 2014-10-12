<?php namespace Metin2CMS\Core\Exceptions;

class RegistrationFailedException extends AbstractException {

    /**
     * @var string
     */
    protected $redirectTo = 'account.register';
}