<?php

namespace Metin\Services\Forms;

use Metin\Validation\FormValidator;

class Registration extends FormValidator
{
    protected $rules = array(
        'username' => 'required',
        'password' => 'required',
        'email'    => 'required'
    );
}