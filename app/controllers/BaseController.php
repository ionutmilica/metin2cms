<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    public function redirectWithError($route, $error)
    {
        return Redirect::route($route)->withInput()->withErrors(array(
            'global' => $error
        ));
    }
}
