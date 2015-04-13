<?php namespace Metin2CMS\Exceptions\Core;

class EmailFailedException extends AbstractException {

    /**
     * @var string
     */
    protected $redirectTo = 'account.email';
}
