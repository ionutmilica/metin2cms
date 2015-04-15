<?php namespace Metin2CMS\Exceptions\Admin;

use Metin2CMS\Exceptions\Core\AbstractException;

class CreateFailedException extends AbstractException {

    protected $redirectTo = 'admin.staff.create';
}