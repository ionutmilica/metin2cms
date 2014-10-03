<?php namespace Metin2CMS\Core\Services\Forms;

use Metin2CMS\Core\Validation\FormValidator;

class Password extends FormValidator
{
    protected $rules = array(
        'old_password' => 'required|between:2, 20',
        'new_password' => 'required',
        'new_password_again' => 'required|same:new_password',
    );
}