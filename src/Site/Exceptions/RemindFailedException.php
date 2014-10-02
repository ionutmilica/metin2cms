<?php namespace Metin2CMS\Site\Exceptions;

class RemindFailedException extends AbstractException {

    /**
     * @var string
     */
    protected $redirectTo = 'account.password-reset';
}