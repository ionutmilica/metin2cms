<?php namespace App\Http\Controllers;

use App\Exceptions\Handler;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

    /**
     * Create a new controller instance.
     *
     * @param Handler $handler
     */
	public function __construct(Handler $handler)
	{
		$this->middleware('auth');
	}

    /**
     * Show the application dashboard to the user.
     */
	public function index()
	{
		//return view('home');
	}

}
