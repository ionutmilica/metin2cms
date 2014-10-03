<?php namespace Metin2CMS\Core\Services\Forms;

use Metin2CMS\Core\Validation\FormValidator;

class Registration extends FormValidator
{
    protected $rules = array(
        'username' => 'required|alpha_num|between:4, 16|unique:account,login',
        'password' => 'required|between:4,20',
        'email'    => 'required|email',
        'password_confirmation' => 'required|same:password'
    );
}