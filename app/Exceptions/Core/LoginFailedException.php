<?php namespace Metin2CMS\Exceptions\Core;

class LoginFailedException extends AbstractException {

    /**
     * @var string
     */
    protected $redirectTo = 'account.login';
}