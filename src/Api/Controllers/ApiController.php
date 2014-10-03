<?php namespace Metin2CMS\Api\Controllers;

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