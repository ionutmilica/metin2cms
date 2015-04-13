<?php namespace Metin2CMS\Http\Requests;

class RegistrationRequest extends Request {

    public function rules()
    {
        return [
            'username'          => 'required|alpha_num|between:4, 16|unique:account,login',
            'password'          => 'required|between:4,20|confirm',
            'email'             => 'required|email',
        ];
    }
}