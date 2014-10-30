<?php namespace Metin2CMS\Admin\Handlers;

class AccountEventHandler extends AbstractEventHandler {

    public function onAccountBlock($event)
    {
        $id = $event['account'];
        $type = 'blocked';
        $data = sprintf('Blocked until %s with the reason: %s', $event['expiration'], $event['reason']);

        $this->app['history']->create($id, $type, $data);
    }

    /**
     * @param $event
     */
    public function onAccountUnBlock($event)
    {
        $id = $event['account'];
        $type = 'unblocked';

        $this->app['history']->create($id, $type);
    }

    /**
     * Subscribe to events
     *
     * @param $events
     */
    public function subscribe($events)
    {
        $this->listen($events, 'account.blocked', 'onAccountBlock');
        $this->listen($events, 'account.unblocked', 'onAccountUnBlock');
    }
} 