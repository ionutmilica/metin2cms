<?php namespace Metin2CMS\Exceptions\Core;

class ConfirmationFailedException extends AbstractException {

    /**
     * @var string
     */
    protected $redirectTo = 'home';
}
