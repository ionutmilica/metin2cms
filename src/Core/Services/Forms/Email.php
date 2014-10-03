<?php namespace Metin2CMS\Core\Services\Forms;

use Metin2CMS\Core\Validation\FormValidator;

class Email extends FormValidator
{
    protected $rules = array(
        'new_email' => 'required|email',
        'old_email' => 'required|email',
    );
}