<?php namespace Metin2CMS\Services;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard as AuthContract;
use Illuminate\Contracts\Events\Dispatcher as EventContract;
use Illuminate\Session\Store as SessionContract;
use Metin2CMS\Exceptions\Core\ConfirmationFailedException;
use Metin2CMS\Exceptions\Core\DeletionCodeException;
use Metin2CMS\Exceptions\Core\EmailFailedException;
use Metin2CMS\Exceptions\Core\LoginFailedException;
use Metin2CMS\Exceptions\Core\PasswordFailedException;
use Metin2CMS\Exceptions\Core\RemindFailedException;
use Metin2CMS\Exceptions\Core\SafeboxException;
use Metin2CMS\Mailers\AccountMailer;
use Metin2CMS\Repositories\AccountMetaRepositoryInterface;
use Metin2CMS\Repositories\AccountRepositoryInterface;
use Metin2CMS\Repositories\ReminderRepositoryInterface;
use Metin2CMS\Repositories\SafeboxRepositoryInterface;

class AccountService {

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * @var \Metin2CMS\Repositories\AccountRepositoryInterface
     */
    protected $account;

    /**
     * @var \Metin2CMS\Repositories\ReminderRepositoryInterface
     */
    protected $reminder;

    /**
     * @var \Metin2CMS\Repositories\SafeboxRepositoryInterface
     */
    protected $safebox;
    /**
     * @var \Metin2CMS\Mailers\AccountMailer
     */
    private $accountMailer;
    /**
     * @var AccountMetaRepositoryInterface
     */
    private $meta;
    /**
     * @var Dispatcher
     */
    private $events;
    /**
     * @var Guard
     */
    private $auth;
    /**
     * @var Store
     */
    private $session;

    /**
     * @param \Metin2CMS\Repositories\AccountRepositoryInterface     $account
     * @param \Metin2CMS\Repositories\ReminderRepositoryInterface    $reminder
     * @param \Metin2CMS\Repositories\SafeboxRepositoryInterface     $safebox
     * @param \Metin2CMS\Repositories\AccountMetaRepositoryInterface $meta
     * @param AccountMailer                                          $mailer
     * @param EventContract                                          $events
     * @param AuthContract                                           $auth
     * @param SessionContract                                        $session
     */
    public function __construct(AccountRepositoryInterface $account,
                                ReminderRepositoryInterface $reminder,
                                SafeboxRepositoryInterface $safebox,
                                AccountMetaRepositoryInterface $meta,
                                AccountMailer $mailer,
                                EventContract $events,
                                AuthContract $auth,
                                SessionContract $session)
    {
        $this->account = $account;
        $this->reminder = $reminder;
        $this->safebox = $safebox;
        $this->meta = $meta;
        $this->accountMailer = $mailer;
        $this->events = $events;
        $this->auth = $auth;
        $this->session = $session;
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

        $this->events->fire('account.creating', array(&$data));

        $account = $this->account->create($data);

        if ($account)
        {
            $this->events->fire('account.created', array($account));
            return $account;
        }

        return false;
    }

    /**
     * Confirm user account
     *
     * @param $user
     * @param $token
     * @throws \Metin2CMS\Exceptions\Core\ConfirmationFailedException
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

        $this->events->fire('account.confirming', array($account));

        $wasConfirmed = (bool) $this->account->update(array('id' => $account['id']), array(
            'confirmation_token' => '',
            'status' => 'OK'
        ));

        if ($wasConfirmed)
        {
            $this->events->fire('account.confirmed', array($account));
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
        $this->events->fire('account.login.before', array($data));

        $remember = isset($data['remember']) && $data['remember'] != null ? true : false;

        if ($this->account->isBlocked($data['username']))
        {
            throw new LoginFailedException('Your account is blocked.');
        }

        if ($this->account->isDisabled($data['username']))
        {
            throw new LoginFailedException('Your account is not activated yet.');
        }

        $auth = $this->auth->attempt(array(
            'username' => $data['username'],
            'password' => $data['password']
        ), $remember);

        if ( ! $auth)
        {
            $this->events->fire('account.login.fail', array($data));

            throw new LoginFailedException('Username or password is incorrect.');
        }

        $this->events->fire('account.login.success', array($data));

        return true;
    }

    /**
     * Logout user from the application
     *
     * @return bool
     */
    public function logout()
    {
        $this->events->fire('account.logout.before');

        $this->auth->logout();
        $this->session->flush();

        $this->events->fire('account.logout.after');

        return true;
    }

    /**
     * Generate a new password for the user
     *
     * @param array $data
     * @throws \Metin2CMS\Exceptions\Core\RemindFailedException
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

        $this->events->fire('account.remind.before', array($data));

        $wasCreated = $this->reminder->create($data);

        if ($wasCreated)
        {
            $this->events->fire('account.remind.after', array($data));
        }

        return $wasCreated;
    }

    /**
     * Confirm the generated user password
     *
     * @param $username
     * @param $token
     * @throws \Metin2CMS\Exceptions\Core\RemindFailedException
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

        $this->events->fire('account.password_confirm.before', array($reminder));

        $wasChanged = $this->account->changePassword($username, $reminder['password']);

        if ($wasChanged)
        {
            $this->events->fire('account.password_confirm.after', array($reminder));
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
     * @throws \Metin2CMS\Exceptions\Core\PasswordFailedException
     */
    public function password(array $data, $user)
    {
        $hashed_pass = mysqlHash($data['old_password']);

        if ($hashed_pass !== $this->account->authPassword($user->id))
        {
            throw new PasswordFailedException('Your old password is incorrect.');
        }

        $this->events->fire('account.password.before', array($data));

        $wasChanged = $this->account->changePassword($user->login, mysqlHash($data['new_password']));

        if ($wasChanged)
        {
            $this->meta->set($user->id, 'password_last', Carbon::now());
            $this->events->fire('account.password.after', array($data));
        }

        return $wasChanged;
    }

    /**
     * Change email
     *
     * @param $user
     * @param array $data
     * @return bool
     * @throws \Metin2CMS\Exceptions\Core\EmailFailedException
     */
    public function email($user, array $data)
    {
        $user = $this->account->findById($user);

        if ($data['old_email'] != $user['email'])
        {
            throw new EmailFailedException('Your old email doesn\'t match with your current account.');
        }

        $data['id'] = $user['id'];
        $data['account'] = $user['login'];

        $this->events->fire('account.email.before', array($data));

        $wasEmailChanged = (bool) $this->account->changeEmail($user['id'], $data['new_email']);

        if ($wasEmailChanged)
        {
            $this->meta->set($user['id'], 'email_last', Carbon::now());
            $this->events->fire('account.email.after', array($data));
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

        $this->events->fire('account.safebox.before', array($data));

        $wasSent = $this->accountMailer->safebox($data)->send();
        if ($wasSent)
        {
            $this->meta->set($user, 'safebox_last', Carbon::now());
            $this->events->fire('account.safebox.after', array($data));
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

        $this->events->fire('account.deletion_code.before', array($data));

        $wasUpdated = $this->account->update(array('id' => $user), array(
            'social_id' => $data['deletionCode']
        ));

        if ($wasUpdated)
        {
            $this->events->fire('account.deletion_code.after', array($data));

            $this->meta->set($user, 'deletion_last', Carbon::now());

            $this->accountMailer->deletionCode($data)->send();
        }

        return $wasUpdated;
    }

}

