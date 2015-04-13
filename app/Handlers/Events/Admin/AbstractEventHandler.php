<?php namespace Metin2CMS\Handlers\Events\Admin;

class AbstractEventHandler {

    /**
     * Helper for event listeners
     *
     * @param $events \Illuminate\Contracts\Events\Dispatcher
     * @param $event
     * @param $listener
     */
    public function listen($events, $event, $listener)
    {
        $events->listen($event, get_called_class().'@'.$listener);
    }
}