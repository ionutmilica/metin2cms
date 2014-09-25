<?php

namespace Metin\Services\Forms;

use Metin\Validation\FormValidator;

class Password extends FormValidator
{
    protected $rules = array(
        'old_password' => 'required|between:2, 20',
        'new_password' => 'required',
        'new_password_again' => 'required|same:new_password',
    );
}