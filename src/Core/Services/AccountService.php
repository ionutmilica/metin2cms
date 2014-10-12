<?php namespace Metin2CMS\Core\Services;

use Illuminate\Foundation\Application;
use Metin2CMS\Core\Exceptions\EmailFailedException;
use Metin2CMS\Core\Exceptions\LoginFailedException;
use Metin2CMS\Core\Exceptions\PasswordFailedException;
use Metin2CMS\Core\Exceptions\RemindFailedException;
use Metin2CMS\Core\Exceptions\SafeboxException;
use Metin2CMS\Core\Mailers\AccountMailer;
use Metin2CMS\Core\Repositories\AccountRepositoryInterface;
use Metin2CMS\Core\Repositories\ReminderRepositoryInterface;
use Metin2CMS\Core\Repositories\SafeboxRepositoryInterface;

class AccountService {

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * @var \Metin2CMS\Core\Repositories\AccountRepositoryInterface
     */
    protected $account;

    /**
     * @var \Metin2CMS\Core\Repositories\ReminderRepositoryInterface
     */
    protected $reminder;

    /**
     * @var \Metin2CMS\Core\Repositories\SafeboxRepositoryInterface
     */
    protected $safebox;
    /**
     * @var \Metin2CMS\Core\Mailers\AccountMailer
     */
    private $accountMailer;

    /**
     * @param Application $app
     * @param \Metin2CMS\Core\Repositories\AccountRepositoryInterface $account
     * @param \Metin2CMS\Core\Repositories\ReminderRepositoryInterface $reminder
     * @param \Metin2CMS\Core\Repositories\SafeboxRepositoryInterface $safebox
     * @param \Metin2CMS\Core\Mailers\AccountMailer $accountMailer
     */
    public function __construct(Application $app,
                                AccountRepositoryInterface $account,
                                ReminderRepositoryInterface $reminder,
                                SafeboxRepositoryInterface $safebox,
                                AccountMailer $accountMailer)
    {
        $this->app = $app;
        $this->account = $account;
        $this->reminder = $reminder;
        $this->safebox = $safebox;
        $this->accountMailer = $accountMailer;
    }

    /**
     * Create user account
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $data['login'] = $data['username'];

        $this->app['events']->fire('account.creating', array(&$data));

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
        // To make sure that the token it's not null or \0
        if (empty($token)) $token = '-1';

        $confirmation = (bool) $this->account->update(array('login' => $user, 'confirmation_token' => $token), array(
            'confirmation_token' => '',
            'status' => 'OK'
        ));

        if ($confirmation)
        {
            $this->app['events']->fire('account.confirmed', array(
                'login' => $user,
                'token' => $token,
            ));

            return true;
        }

        return false;
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
            throw new RemindFailedException('This token is invalid.', 'home');
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
        $account = $this->account->findById($user);

        if ( ! $account)
        {
            throw new SafeboxException('This account doesn\'t exists');
        }

        $safebox = $this->safebox->findByAccount($account['id']);

        if ( ! $safebox)
        {
            throw new SafeboxException('Your current account doesn\'t have a safebox.');
        }

        $data = array(
            'login'   => $account['login'],
            'email'   => $account['email'],
            'safebox' => $safebox['password']
        );

        $this->accountMailer->safebox($data)->send();

        return true;
    }
}

