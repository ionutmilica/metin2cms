<?php namespace Metin2CMS\Core\Exceptions;

class DeletionCodeException extends AbstractException {

    /**
     * @var string
     */
    protected $redirectTo = 'account.deletion_code';
}