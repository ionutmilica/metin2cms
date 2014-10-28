<?php namespace Metin2CMS\Core\Exceptions;

use Exception;

abstract class AbstractException extends Exception {

    /**
     * @var string
     */
    protected $redirectTo;

    /**
     * @param string $message
     * @param null $redirectTo
     * @param int $code
     */
    public function __construct($message, $redirectTo = null, $code = 0)
    {
        parent::__construct($message, $code);

        $this->setRedirection($redirectTo);
    }

    /**
     * @param $redirectTo
     * @return bool
     */
    public function setRedirection($redirectTo)
    {
        if ($redirectTo !== null)
        {
            $this->redirectTo = $redirectTo;

            return true;
        }

        return false;
    }

    /**
     * Get the route we should redirect to
     *
     * @return int
     */
    public function getRedirection()
    {
        return $this->redirectTo;
    }
}