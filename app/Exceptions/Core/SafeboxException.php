<?php namespace Metin2CMS\Exceptions\Core;

class SafeboxException extends AbstractException {

    /**
     * @var string
     */
    protected $redirectTo = 'account.safebox';
}