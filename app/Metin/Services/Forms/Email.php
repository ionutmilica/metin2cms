<?php

namespace Metin\Services\Forms;

use Metin\Validation\FormValidator;

class Email extends FormValidator
{
    protected $rules = array(
        'new_email' => 'required|email',
        'old_email' => 'required|email',
    );
}