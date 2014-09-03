<?php

namespace Metin\Services\Forms;

use Metin\Validation\FormValidator;

class Registration extends FormValidator
{
    protected $rules = array(
        'username' => 'required|alpha_num|between:4, 16',
        'password' => 'required|confirmed',
        'email'    => 'required|email'
    );
}