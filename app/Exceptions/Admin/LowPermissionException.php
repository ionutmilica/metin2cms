<?php namespace Metin2CMS\Exceptions\Admin;

use Metin2CMS\Exceptions\Core\AbstractException;

class LowPermissionException extends AbstractException {

    protected $redirectTo = 'admin.account.block';
}