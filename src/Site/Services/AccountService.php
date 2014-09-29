<?php namespace Metin2CMS\Site\Services;

use Exception;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;

class AccountService {

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * @var \Metin2CMS\Site\Repositories\AccountRepositoryInterface
     */
    protected $account;

    /**
     * @var \Metin2CMS\Site\Repositories\ReminderRepositoryInterface
     */
    protected $reminder;

    /**
     * @var \Metin2CMS\Site\Repositories\SafeboxRepositoryInterface
     */
    protected $safebox;

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->account = $this->app->make('Metin2CMS\Site\Repositories\AccountRepositoryInterface');
        $this->reminder = $this->app->make('Metin2CMS\Site\Repositories\ReminderRepositoryInterface');
        $this->safebox = $this->app->make('Metin2CMS\Site\Repositories\SafeboxRepositoryInterface');
    }

    /**
     * Create user account
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        //@TODO: Make use of events for this kind of configurations
        $data['login'] = $data['username'];
        $data['status'] = 'BLOCK';
        $data['confirmation_token'] = str_random(64);

        $account = $this->app['events']->fire('account.creating', array(&$data));

        $account = $this->account->create($data);

        if ($account)
        {
            $this->app['events']->fire('account.created', array($account));

            return $account;
        }

        return false;
    }

    /**
     * Confirm user account
     *
     * @param $user
     * @param $token
     * @return bool
     */
    public function confirmAccount($user, $token)
    {
        return (bool) $this->account->update(array('login' => $user, 'confirmation_token' => $token), array(
            'confirmation_token' => '',
            'status' => 'OK'
        ));
    }

    /**
     * Authenticate the user
     *
     * @param array $data
     * @return bool
     * @throws LoginFailedException
     */
    public function authenticate(array $data)
    {
        $this->app['events']->fire('account.auth.before', array($data));

        $remember = isset($data['remember']) && $data['remember'] != null ? true : false;

        if ($this->account->isBlocked($data['username']))
        {
            throw new LoginFailedException('Your account is blocked.');
        }

        if ($this->account->isDisabled($data['username']))
        {
            throw new LoginFailedException('Your account is not activated yet.');
        }

        $auth = Auth::attempt(array(
            'username' => $data['username'],
            'password' => $data['password']
        ), $remember);

        if ( ! $auth)
        {
            $this->app['events']->fire('account.auth.failed', array($data));

            throw new LoginFailedException('Username or password is incorrect.');
        }

        $this->app['events']->fire('account.auth.successful', array($data));

        return true;
    }

    public function logout()
    {
        $this->app['auth']->logout();
        $this->app['session.store']->flush();

        return true;
    }

    /**
     * Generate a new password for the user
     *
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function remind(array $data)
    {
        $account = $this->account->findByName($data['username']);

        if ( ! $account || $account['email'] != $data['email'])
        {
            throw new RemindFailedException('Can\'t find account by the provided user and email.');
        }

        $token    = str_random(64);
        $password = str_random(10);

        return $this->reminder->generatePassword($data, $token, $password);
    }

    /**
     * Confirm the generated user password
     *
     * @param $token
     * @return bool
     * @throws \Exception
     */
    public function confirmNewPassword($token)
    {
        $reminder = $this->reminder->findByToken($token);

        if ( ! $reminder || $reminder['token'] != $token)
        {
            throw new RemindFailedException('This token is invalid.');
        }

        $change = $this->account->changePassword($reminder);

        if ($change)
        {
            // Delete token
            $this->reminder->deleteToken($token);
            
            return true;
        }
    }

    public function password(array $data, $user)
    {
        $hashed_pass = mysqlHash($data['old_password']);

        if ($hashed_pass !== $this->account->authPassword($user->id))
        {
            throw new PasswordFailedException('Your old password is incorrect.');
        }

        $data = array(
            'password' => mysqlHash($data['new_password']),
            'username' => $user->login
        );

        return (bool) $this->account->changePassword($data);
    }

    public function email($user, array $data)
    {
        $user = $this->account->findById($user);

        if ($data['old_email'] != $user['email'])
        {
            throw new EmailFailedException('Your old email doesn\'t match with your current account.');
        }

        return (bool) $this->account->changeEmail($user['id'], $data['new_email']);
    }

    /**
     * Request safebox password
     *
     * @param $user
     * @throws SafeboxException
     * @return bool
     */
    public function safebox($user)
    {
        $safebox = $this->safebox->findByAccount($user);

        if ( ! $safebox)
        {
            throw new SafeboxException('Your current account doesn\'t have a safebox.');
        }

        // Send an email

        return true;
    }
}

// Exceptions - Considering about moving them in the future
class LoginFailedException extends Exception {}
class RemindFailedException extends Exception {}
class PasswordFailedException extends Exception {}
class EmailFailedException extends Exception {}
class SafeboxException extends Exception {}