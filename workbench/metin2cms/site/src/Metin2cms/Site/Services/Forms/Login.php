<?php namespace Metin2cms\Site\Services\Forms;

use Metin2cms\Site\Validation\FormValidator;

class Login extends FormValidator
{
    protected $rules = array(
        'username' => 'required|alpha_num',
        'password' => 'required',
    );
}