<?php namespace Metin2CMS\Core\Exceptions;

class LoginFailedException extends AbstractException {

    /**
     * @var string
     */
    protected $redirectTo = 'account.login';
}