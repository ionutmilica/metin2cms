<?php namespace Metin2CMS\Http\Requests;

class AuthRequest extends Request {

    /**
     * Router to where we redirect if the auth data are invalid
     *
     * @var string
     */
    protected $redirectRoute = 'home';

    public function rules()
    {
        return [
            'username' => 'required|alpha_num',
            'password' => 'required',
        ];
    }
}