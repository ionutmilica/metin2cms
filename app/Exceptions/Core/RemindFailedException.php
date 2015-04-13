<?php namespace Metin2CMS\Exceptions\Core;

class RemindFailedException extends AbstractException {

    /**
     * @var string
     */
    protected $redirectTo = 'account.password-reset';
}