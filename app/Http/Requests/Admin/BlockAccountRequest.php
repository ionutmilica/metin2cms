<?php namespace Metin2CMS\Http\Requests\Admin;

use Illuminate\Http\Request;

class BlockAccountRequest extends Request {

    public function rules()
    {
        return [
            'reason'      => 'required',
            'expiration'  => 'required|date_format:"Y/m/d H:i',
        ];
    }
}