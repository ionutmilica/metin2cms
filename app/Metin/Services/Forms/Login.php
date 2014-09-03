<?php

namespace Metin\Services\Forms;

use Metin\Validation\FormValidator;

class Login extends FormValidator
{
    protected $rules = array(
        'username' => 'required',
        'password' => 'required',
    );
}