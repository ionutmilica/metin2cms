<?php namespace Metin2CMS\Site\Services\Forms;

use Metin2CMS\Site\Validation\FormValidator;

class Password extends FormValidator
{
    protected $rules = array(
        'old_password' => 'required|between:2, 20',
        'new_password' => 'required',
        'new_password_again' => 'required|same:new_password',
    );
}