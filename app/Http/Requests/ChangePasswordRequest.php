<?php namespace Metin2CMS\Http\Requests;

class ChangePasswordRequest extends Request {

    public function rules()
    {
        return [
            'new_email' => 'required|email',
            'old_email' => 'required|email',
        ];
    }
}