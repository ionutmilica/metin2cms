<?php namespace Metin2CMS\Exceptions\Core;

class DeletionCodeException extends AbstractException {

    /**
     * @var string
     */
    protected $redirectTo = 'account.deletion_code';
}