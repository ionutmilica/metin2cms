<?php namespace Metin2CMS\Core\Exceptions;

class RemindFailedException extends AbstractException {

    /**
     * @var string
     */
    protected $redirectTo = 'account.password-reset';
}