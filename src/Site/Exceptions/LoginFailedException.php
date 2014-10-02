<?php namespace Metin2CMS\Site\Exceptions;

class LoginFailedException extends AbstractException {

    /**
     * @var string
     */
    protected $redirectTo = 'account.login';
}