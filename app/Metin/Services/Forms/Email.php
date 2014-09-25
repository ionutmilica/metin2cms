<?php

namespace Metin\Services\Forms;

use Metin\Validation\FormValidator;

class Email extends FormValidator
{
    protected $rules = array(
        'email' => 'required|email',
    );
}