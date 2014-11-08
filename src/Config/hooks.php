<?php

/**
 * Listen before account creating. If the site doesn't ask for account confirmation
 * we confirm the account from here
 */
use Carbon\Carbon;

Event::listen('account.creating', function (&$data)
{
    if (Config::get('general.register.confirmation'))
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
    if (Config::get('general.register.closed') == true)
    {
        throw new \Metin2CMS\Core\Exceptions\RegistrationFailedException(Config::get('general.register.message'));
    }
});

/**
 * If the site needs confirmation, we'll send an email with the token from this listener
 */
Event::listen('account.created', function ($data)
{
    if (Config::get('general.register.confirmation') == true)
    {
        $mailer = app()->make('Metin2CMS\Core\Mailers\AccountMailer');
        $mailer->confirmation($data)->send();
    }
});

Event::listen('account.remind.after', function ($data)
{
    $mailer = app()->make('Metin2CMS\Core\Mailers\AccountMailer');
    $mailer->reminding($data)->send();
});

Event::listen('account.safebox.before', function ($data)
{
    $last_request = app()->make('Metin2CMS\Core\Repositories\AccountMetaRepositoryInterface')
        ->get($data['id'], 'safebox_last');

    $until = with(new Carbon($last_request))->timestamp + Config::get('general.flood.safebox');

    if ($last_request && $until > Carbon::now()->timestamp)
    {
        $message = sprintf('You must wait until %s to request your safebox password.',
            Carbon::createFromTimestamp($until)->toDateTimeString());

        throw new \Metin2CMS\Core\Exceptions\SafeboxException($message);
    }
});

Event::listen('account.deletion_code.before', function ($data)
{
    $last_request = app()->make('Metin2CMS\Core\Repositories\AccountMetaRepositoryInterface')
                         ->get($data['id'], 'deletion_last');

    $until = with(new Carbon($last_request))->timestamp + Config::get('general.flood.deletion');

    if ($last_request && $until > Carbon::now()->timestamp)
    {
        $message = sprintf('You must wait until %s to reset your deletion code.',
            Carbon::createFromTimestamp($until)->toDateTimeString());

        throw new \Metin2CMS\Core\Exceptions\DeletionCodeException($message);
    }
});

Event::listen('account.email.before', function ($data)
{
    $last_request = app()->make('Metin2CMS\Core\Repositories\AccountMetaRepositoryInterface')
        ->get($data['id'], 'email_last');

    $until = with(new Carbon($last_request))->timestamp + Config::get('general.flood.email');

    if ($last_request && $until > Carbon::now()->timestamp)
    {
        $message = sprintf('You must wait until %s change your email address.',
            Carbon::createFromTimestamp($until)->toDateTimeString());

        throw new \Metin2CMS\Core\Exceptions\EmailFailedException($message);
    }
});