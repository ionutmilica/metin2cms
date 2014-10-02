<?php namespace Metin2CMS\Site\Exceptions;

class SafeboxException extends AbstractException {

    /**
     * @var string
     */
    protected $redirectTo = 'account.safebox';
}