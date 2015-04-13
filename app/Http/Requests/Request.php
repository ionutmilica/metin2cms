<?php namespace Metin2CMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest {

	//
    public function authorize()
    {
        return true;
    }
}
