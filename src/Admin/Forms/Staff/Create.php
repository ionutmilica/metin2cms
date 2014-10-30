<?php namespace Metin2CMS\Admin\Forms\Staff;

use Metin2CMS\Core\Validation\FormValidator;

class Create extends FormValidator
{
    protected $rules = array(
        'account' => 'required|alpha_num',
        'player'  => 'required|alpha_num',
        'grade'   => 'required|alpha_num',
    );
}