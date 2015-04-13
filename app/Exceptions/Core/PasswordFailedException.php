<?php namespace Metin2CMS\Exceptions\Core;

class PasswordFailedException extends AbstractException {

    /**
     * @var string
     */
    protected $redirectTo = 'account.password';
}
