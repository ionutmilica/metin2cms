<?php namespace Metin2CMS\Core\Extensions;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserProviderInterface;
use Metin2CMS\Core\Entities\Account;

class MetinAuthProvider implements UserProviderInterface{

    /**
     * Account model
     *
     * @var Account
     */
    protected $account;

    /**
     * @param Account $account
     */
    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    /**
     * @param mixed $id
     * @return GenericUser|UserInterface|null
     */
    public function retrieveById($id)
    {
        $account = $this->account->find($id);

        if ( ! is_null($account))
        {
            $accountArr = $account->toArray();
            $accountArr['password'] = $account->password;

            return new GenericUser($accountArr);
        }

        return null;
    }

    /**
     * Retrieve user by credentials
     *
     * @param array $credentials
     * @return GenericUser
     */
    public function retrieveByCredentials(array $credentials)
    {
        $account = $this->account->newInstance();

        foreach ($credentials as $key => $value)
		{
            if ($key == 'username')
            {
                $key = 'login';
            }

            if ( ! str_contains($key, 'password'))
            {
                $account = $account->where($key, $value);
            }
        }

       $user = $account->first();

		if ( ! is_null($user))
        {
            $userArr = $user->toArray();
            $userArr['password'] = $user->password;

            return new GenericUser($userArr);
        }

        return null;
    }

    /**
     * Check user password
     *
     * @param UserInterface $user
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials(UserInterface $user, array $credentials)
    {
        $credentials['password'] = mysqlHash($credentials['password']);

        return $user->getAuthPassword() == $credentials['password'];
    }

    /**
     * Retrieve user by remember token
     *
     * @param mixed $identifier
     * @param string $token
     * @return GenericUser
     */
    public function retrieveByToken($identifier, $token)
    {
        $result = $this->account->where($this->account->getKeyName(), $identifier)
                ->where($this->account->getRememberTokenName(), $token)
                ->first();

        if ($result)
        {
            $account = $result->toArray();
            $account['password'] = $result->password;
            $result = $account;
        }

        return new GenericUser($result);
    }

    /**
     * Update the remember token
     *
     * @param UserInterface $user
     * @param string $token
     */
    public function updateRememberToken(UserInterface $user, $token)
    {
        $this->account->where('id', $user->id)->update(array(
            $user->getRememberTokenName() => $token
        ));
    }

}