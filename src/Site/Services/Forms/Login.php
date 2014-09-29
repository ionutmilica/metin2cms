<?php namespace Metin2CMS\Site\Services\Forms;

use Metin2CMS\Site\Validation\FormValidator;

class Login extends FormValidator
{
    protected $rules = array(
        'username' => 'required|alpha_num',
        'password' => 'required',
    );
}