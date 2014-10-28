<?php namespace Metin2CMS\Admin\Forms;

use Metin2CMS\Core\Validation\FormValidator;

class Block extends FormValidator
{
    protected $rules = array(
        'reason'      => 'required',
        'expiration'  => 'required|date_format:"Y/m/d H:i',
    );
}