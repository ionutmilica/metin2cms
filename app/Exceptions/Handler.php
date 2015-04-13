<?php namespace Metin2CMS\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Redirect;
use Metin2CMS\Exceptions\Core\AbstractException;
use Metin2CMS\Core\Validation\FormValidationException;

class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException'
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		return parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{
        //Temp
        if ($e instanceof FormValidationException) {
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

        if ($e instanceof AbstractException) {
            return Redirect::route($e->getRedirection())->withInput()->withErrors(array(
                'global' => $e->getMessage()
            ));
        }

		return parent::render($request, $e);
	}

}
