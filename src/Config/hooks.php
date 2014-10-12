<?php

/**
 * Listen before account creating. If the site doesn't ask for account confirmation
 * we confirm the account from here
 */
Event::listen('account.creating', function (&$data)
{
    if (Config::get('register.confirmation'))
    {
        $data['status'] = 'BLOCK';
        $data['confirmation_token'] = str_random(64);
    }
    else
    {
        $data['status'] = 'OK';
    }
});

/**
 * Closing registration for a specific reason
 */
Event::listen('account.creating', function (&$data)
{
    if (Config::get('register.closed') == true)
    {
        throw new \Metin2CMS\Core\Exceptions\LoginFailedException(Config::get('register.message'));
    }
});

/**
 * If the site needs confirmation, we'll send an email with the token from this listener
 */
Event::listen('account.created', function ($data)
{
    if (Config::get('register.confirmation') == true)
    {
        $mailer = app()->make('Metin2CMS\Core\Mailers\AccountMailer');
        $mailer->confirmation($data)->send();
    }
});
