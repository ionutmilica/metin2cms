<?php namespace Metin2CMS\Core\Exceptions;

class EmailFailedException extends AbstractException {

    /**
     * @var string
     */
    protected $redirectTo = 'account.email';
}
