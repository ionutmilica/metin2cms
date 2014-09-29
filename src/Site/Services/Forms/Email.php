<?php namespace Metin2CMS\Site\Services\Forms;

use Metin2CMS\Site\Validation\FormValidator;

class Email extends FormValidator
{
    protected $rules = array(
        'new_email' => 'required|email',
        'old_email' => 'required|email',
    );
}