<?php namespace Metin2CMS\Site\Exceptions;

class PasswordFailedException extends AbstractException {

    /**
     * @var string
     */
    protected $redirectTo = 'account.password';
}
