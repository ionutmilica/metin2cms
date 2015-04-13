<?php namespace Metin2CMS\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller {

    public function __construct()
    {

    }

    public function json($data, $status = 200)
    {
        return Response::json($data, $status);
    }
}