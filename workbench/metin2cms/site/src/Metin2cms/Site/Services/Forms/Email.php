<?php namespace Metin2cms\Site\Services\Forms;

use Metin2cms\Site\Validation\FormValidator;

class Email extends FormValidator
{
    protected $rules = array(
        'new_email' => 'required|email',
        'old_email' => 'required|email',
    );
}