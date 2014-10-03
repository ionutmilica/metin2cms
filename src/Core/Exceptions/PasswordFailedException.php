<?php namespace Metin2CMS\Core\Exceptions;

class PasswordFailedException extends AbstractException {

    /**
     * @var string
     */
    protected $redirectTo = 'account.password';
}
