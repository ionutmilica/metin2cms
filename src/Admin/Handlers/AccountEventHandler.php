<?php namespace Metin2CMS\Admin\Handlers;

class AccountEventHandler extends AbstractEventHandler {

    public function onAccountCreated($event)
    {
        $id = $event['id'];
        $type = 'created';
        $data = sprintf('Created with initial username: %s and email: %s.', $event['login'], $event['email']);

        $this->app['history']->create($id, $type, $data);
    }

    public function onAccountConfirmed($event)
    {
        $id = $event['id'];
        $type = 'confirmed';
        $data = sprintf('Confirmed account with email %s !', $event['email']);

        $this->app['history']->create($id, $type, $data);
    }

    /**
     * Do stuff on account block
     *
     * @param $event
     */
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
        $this->listen($events, 'account.created', 'onAccountCreated');
        $this->listen($events, 'account.confirmed', 'onAccountConfirmed');
        $this->listen($events, 'account.blocked', 'onAccountBlock');
        $this->listen($events, 'account.unblocked', 'onAccountUnBlock');
    }
} 