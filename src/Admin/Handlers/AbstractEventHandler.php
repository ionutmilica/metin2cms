<?php namespace Metin2CMS\Admin\Handlers;

use Illuminate\Foundation\Application;

class AbstractEventHandler {

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Helper for event listeners
     *
     * @param $events
     * @param $event
     * @param $listener
     */
    public function listen($events, $event, $listener)
    {
        $events->listen($event, get_called_class().'@'.$listener);
    }
}