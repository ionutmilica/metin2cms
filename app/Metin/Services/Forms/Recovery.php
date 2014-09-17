<?php

namespace Metin\Services\Forms;

use Metin\Validation\FormValidator;

class Recovery extends FormValidator
{
    protected $rules = array(
        'username' => 'required',
        'email'    => 'required|email',
    );
}