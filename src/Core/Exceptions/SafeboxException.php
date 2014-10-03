<?php namespace Metin2CMS\Core\Exceptions;

class SafeboxException extends AbstractException {

    /**
     * @var string
     */
    protected $redirectTo = 'account.safebox';
}