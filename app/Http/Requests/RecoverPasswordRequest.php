<?php namespace Metin2CMS\Http\Requests;

class RecoverPasswordRequest extends Request {

    public function rules()
    {
        return [
            'username' => 'required|alpha_num',
            'email'    => 'required|email',
        ];
    }
}