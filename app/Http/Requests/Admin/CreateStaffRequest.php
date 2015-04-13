<?php namespace Metin2CMS\Http\Requests\Admin;

use Illuminate\Http\Request;

class CreateStaffRequest extends Request {

    public function rules()
    {
        return [
            'account' => 'required|alpha_num',
            'player'  => 'required|alpha_num',
            'grade'   => 'required|alpha_num',
        ];
    }
}