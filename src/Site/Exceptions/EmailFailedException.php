<?php namespace Metin2CMS\Site\Exceptions;

class EmailFailedException extends AbstractException {

    /**
     * @var string
     */
    protected $redirectTo = 'account.email';
}
