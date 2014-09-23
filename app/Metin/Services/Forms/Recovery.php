<?php

namespace Metin\Services\Forms;

use Metin\Validation\FormValidator;

class Recovery extends FormValidator
{
    protected $rules = array(
        'username' => 'required|alpha_num',
        'email'    => 'required|email',
    );
}