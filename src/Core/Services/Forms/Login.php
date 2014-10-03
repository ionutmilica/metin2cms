<?php namespace Metin2CMS\Core\Services\Forms;

use Metin2CMS\Core\Validation\FormValidator;

class Login extends FormValidator
{
    protected $rules = array(
        'username' => 'required|alpha_num',
        'password' => 'required',
    );
}