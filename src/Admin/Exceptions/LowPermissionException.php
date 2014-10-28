<?php namespace Metin2CMS\Admin\Exceptions;

use Metin2CMS\Core\Exceptions\AbstractException;

class LowPermissionException extends AbstractException {

    protected $redirectTo = 'admin.account.block';
}