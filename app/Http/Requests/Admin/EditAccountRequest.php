<?php namespace Metin2CMS\Http\Requests\Admin;

use Illuminate\Http\Request;

class EditAccountRequest extends Request {

    public function rules()
    {
        return [
            'username' => 'required|alpha_num',
            'email'    => 'required|email',
        ];
    }
}