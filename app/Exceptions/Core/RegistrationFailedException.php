<?php namespace Metin2CMS\Exceptions\Core;

class RegistrationFailedException extends AbstractException {

    /**
     * @var string
     */
    protected $redirectTo = 'account.register';
}