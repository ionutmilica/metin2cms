<?php namespace Metin2CMS\Admin\Exceptions;

use Metin2CMS\Core\Exceptions\AbstractException;

class CreateFailedException extends AbstractException {

    protected $redirectTo = 'admin.staff.create';
}