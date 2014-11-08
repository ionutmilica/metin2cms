<?php namespace Metin2CMS\Core\Services;

use Carbon\Carbon;
use Illuminate\Foundation\Application;
use Metin2CMS\Core\Exceptions\ConfirmationFailedException;
use Metin2CMS\Core\Exceptions\DeletionCodeException;
use Metin2CMS\Core\Exceptions\EmailFailedException;
use Metin2CMS\Core\Exceptions\LoginFailedException;
use Metin2CMS\Core\Exceptions\PasswordFailedException;
use Metin2CMS\Core\Exceptions\RemindFailedException;
use Metin2CMS\Core\Exceptions\SafeboxException;
use Metin2CMS\Core\Mailers\AccountMailer;
use Metin2CMS\Core\Repositories\AccountMetaRepositoryInterface;
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
     * @var AccountMetaRepositoryInterface
     */
    private $meta;

    /**
     * @param Application $app
     * @param \Metin2CMS\Core\Repositories\AccountRepositoryInterface $account
     * @param \Metin2CMS\Core\Repositories\ReminderRepositoryInterface $reminder
     * @param \Metin2CMS\Core\Repositories\SafeboxRepositoryInterface $safebox
     * @param \Metin2CMS\Core\Repositories\AccountMetaRepositoryInterface $meta
     * @param \Metin2CMS\Core\Mailers\AccountMailer $accountMailer
     */
    public function __construct(Application $app,
                                AccountRepositoryInterface $account,
                                ReminderRepositoryInterface $reminder,
                                SafeboxRepositoryInterface $safebox,
                                AccountMetaRepositoryInterface $meta,
                                AccountMailer $accountMailer)
    {
        $this->app = $app;
        $this->account = $account;
        $this->reminder = $reminder;
        $this->safebox = $safebox;
        $this->accountMailer = $accountMailer;
        $this->meta = $meta;
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
     * @throws \Metin2CMS\Core\Exceptions\ConfirmationFailedException
     * @return bool
     */
    public function confirmAccount($user, $token)
    {
        $account = $this->account->findByName($user);

        if ( ! $account)
        {
            throw new ConfirmationFailedException('Your account or token is invalid !');
        }

        if ($token === '' || ! $account['confirmation_token'] || $account['confirmation_token'] !== $token)
        {
            return false;
        }

        $this->app['events']->fire('account.confirming', array($account));

        $wasConfirmed = (bool) $this->account->update(array('id' => $account['id']), array(
            'confirmation_token' => '',
            'status' => 'OK'
        ));

        if ($wasConfirmed)
        {
            $this->app['events']->fire('account.confirmed', array($account));
        }

        return $wasConfirmed;
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
        $this->app['events']->fire('account.login.before', array($data));

        $remember = isset($data['remember']) && $data['remember'] != null ? true : false;

        if ($this->account->isBlocked($data['username']))
        {
            throw new LoginFailedException('Your account is blocked.');
        }

        if ($this->account->isDisabled($data['username']))
        {
            throw new LoginFailedException('Your account is not activated yet.');
        }

        $auth = $this->app['auth']->attempt(array(
            'username' => $data['username'],
            'password' => $data['password']
        ), $remember);

        if ( ! $auth)
        {
            $this->app['events']->fire('account.login.fail', array($data));

            throw new LoginFailedException('Username or password is incorrect.');
        }

        $this->app['events']->fire('account.login.success', array($data));

        return true;
    }

    /**
     * Logout user from the application
     *
     * @return bool
     */
    public function logout()
    {
        $this->app['events']->fire('account.logout.before');

        $this->app['auth']->logout();
        $this->app['session.store']->flush();

        $this->app['events']->fire('account.logout.after');

        return true;
    }

    /**
     * Generate a new password for the user
     *
     * @param array $data
     * @throws \Metin2CMS\Core\Exceptions\RemindFailedException
     * @return mixed
     */
    public function remind(array $data)
    {
        $account = $this->account->findByName($data['username']);

        if ( ! $account || $account['email'] != $data['email'])
        {
            throw new RemindFailedException('Can\'t find account by the provided user and email.');
        }

        $this->reminder->deleteByUser($data['username']);

        $data = array(
            'id'       => $account['id'],
            'username' => $account['login'],
            'email'    => $account['email'],
            'login'    => $account['login'],
            'token'    => str_random(64),
            'password' => str_random(10),
        );

        $this->app['events']->fire('account.remind.before', array($data));

        $wasCreated = $this->reminder->create($data);

        if ($wasCreated)
        {
            $this->app['events']->fire('account.remind.after', array($data));
        }

        return $wasCreated;
    }

    /**
     * Confirm the generated user password
     *
     * @param $username
     * @param $token
     * @throws \Metin2CMS\Core\Exceptions\RemindFailedException
     * @return bool
     */
    public function confirmNewPassword($username, $token)
    {
        $reminder = $this->reminder->findByToken($token);

        if ( ! $reminder || $reminder['token'] != $token)
        {
            throw new RemindFailedException('This token is invalid.', 'home');
        }

        if ( $reminder['username'] !== $username)
        {
            throw new RemindFailedException('This user is invalid.', 'home');
        }

        $this->app['events']->fire('account.password_confirm.before', array($reminder));

        $wasChanged = $this->account->changePassword($username, $reminder['password']);

        if ($wasChanged)
        {
            $this->app['events']->fire('account.password_confirm.after', array($reminder));
            $this->reminder->deleteByToken($token);
        }

        return $wasChanged;
    }

    /**
     * Change password
     *
     * @param array $data
     * @param $user
     * @return bool
     * @throws \Metin2CMS\Core\Exceptions\PasswordFailedException
     */
    public function password(array $data, $user)
    {
        $hashed_pass = mysqlHash($data['old_password']);

        if ($hashed_pass !== $this->account->authPassword($user->id))
        {
            throw new PasswordFailedException('Your old password is incorrect.');
        }

        $this->app['events']->fire('account.password.before', array($data));

        $wasChanged = $this->account->changePassword($user->login, mysqlHash($data['new_password']));

        if ($wasChanged)
        {
            $this->meta->set($user->id, 'password_last', Carbon::now());
            $this->app['events']->fire('account.password.after', array($data));
        }

        return $wasChanged;
    }

    /**
     * Change email
     *
     * @param $user
     * @param array $data
     * @return bool
     * @throws \Metin2CMS\Core\Exceptions\EmailFailedException
     */
    public function email($user, array $data)
    {
        $user = $this->account->findById($user);

        if ($data['old_email'] != $user['email'])
        {
            throw new EmailFailedException('Your old email doesn\'t match with your current account.');
        }

        $data['account'] = $user;

        $this->app['events']->fire('account.email.before', array($data));

        $wasEmailChanged = (bool) $this->account->changeEmail($user['id'], $data['new_email']);

        if ($wasEmailChanged)
        {
            $this->meta->set($user['id'], 'email_last', Carbon::now());
            $this->app['events']->fire('account.email.after', array($data));
        }

        return $wasEmailChanged;
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
            'id'      => $account['id'],
            'login'   => $account['login'],
            'email'   => $account['email'],
            'safebox' => $safebox['password']
        );

        $this->app['events']->fire('account.safebox.before', array($data));

        //$wasSent = $this->accountMailer->safebox($data)->send();
        $wasSent = false;
        if ($wasSent)
        {
            $this->meta->set($user, 'safebox_last', Carbon::now());
            $this->app['events']->fire('account.safebox.after', array($data));
        }

        return $wasSent;
    }

    /**
     * Generate a new deletion code and sends it to the email
     *
     * @param $user
     * @return bool
     * @throws DeletionCodeException
     */
    public function deletionCode($user)
    {
        $account = $this->account->findById($user);

        if ( ! $account)
        {
            throw new DeletionCodeException('This account doesn\'t exists');
        }

        $data = array(
            'id'           => $account['id'],
            'email'        => $account['email'],
            'login'        => $account['login'],
            'deletionCode' => str_random(7),
        );

        $this->app['events']->fire('account.deletion_code.before', array($data));

        $wasUpdated = $this->account->update(array('id' => $user), array(
            'social_id' => $data['deletionCode']
        ));

        if ($wasUpdated)
        {
            $this->app['events']->fire('account.deletion_code.after', array($data));

            $this->meta->set($user, 'deletion_last', Carbon::now());

            $this->accountMailer->deletionCode($data)->send();
        }

        return $wasUpdated;
    }
}

