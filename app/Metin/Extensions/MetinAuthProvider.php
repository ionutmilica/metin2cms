<?php

namespace Metin\Extensions;

use Illuminate\Auth\GenericUser;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserProviderInterface;
use Metin\Entities\Account;

class MetinAuthProvider implements UserProviderInterface{

    protected $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    public function retrieveById($id)
    {
        $account = $this->account->find($id);

        if ( ! is_null($account))
        {
            $accountArr = $account->toArray();
            $accountArr['password'] = $account->password;

            return new GenericUser($accountArr);
        }
    }

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
    }

    public function validateCredentials(UserInterface $user, array $credentials)
    {
        $credentials['password'] = mysqlHash($credentials['password']);

        return $user->getAuthPassword() == $credentials['password'];
    }

    public function retrieveByToken($identifier, $token)
    {
        $account = $this->account->newInstance();

        $account->where($account->getKeyName(), $identifier)
                ->where($account->getRememberTokenName(), $token)
                ->first();

        return new GenericUser($account->toArray());
    }

    public function updateRememberToken(UserInterface $user, $token)
    {
        $this->account->where('id', $user->id)->update(array(
            $user->getRememberTokenName() => $token
        ));
    }

}