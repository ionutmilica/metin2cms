<?php namespace Metin2CMS\Http\Requests;

class ChangeEmailRequest extends Request {

    public function rules()
    {
        return [
            'new_email' => 'required|email',
            'old_email' => 'required|email',
        ];
    }
}