<?php namespace Metin2CMS\Site\Services\Forms;

use Metin2CMS\Site\Validation\FormValidator;

class Recovery extends FormValidator
{
    protected $rules = array(
        'username' => 'required|alpha_num',
        'email'    => 'required|email',
    );
}