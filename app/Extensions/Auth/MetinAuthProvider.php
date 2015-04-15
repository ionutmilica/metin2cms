<?php namespace Metin2CMS\Extensions\Auth;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Metin2CMS\Repositories\AccountRepositoryInterface;

class MetinAuthProvider implements UserProvider {

    /**
     * @var AccountRepositoryInterface
     */
    private $account;

    /**
     * @param AccountRepositoryInterface $account
     */
    public function __construct(AccountRepositoryInterface $account)
    {
        $this->account = $account;
    }

    /**
     * @param mixed $id
     * @return GenericUser|null
     */
    public function retrieveById($id)
    {
        $account = $this->account->findByIdWithPassword($id);

        if ( ! is_null($account)) {
            return new GenericUser($account);
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
        $conditions = [];

        foreach ($credentials as $key => $value)
        {
            if ($key == 'username') $key = 'login';
            if ( ! str_contains($key, 'password')) {
                $conditions[$key] = $value;
            }
        }

        $user = $this->account->findByConditions($conditions);

        if ( ! is_null($user)) {
            return new GenericUser($user);
        }

        return null;
    }

    /**
     * Check user password
     *
     * @param Authenticatable $user
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
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
        $result = $this->account->findByConditions([
            $this->account->getKeyName() => $identifier,
            $this->account->getRememberTokenName() => $token
        ]);

        return new GenericUser($result);
    }

    /**
     * Update the remember token
     *
     * @param Authenticatable $user
     * @param string $token
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        $this->account->update(['id' => $user->id], [$user->getRememberTokenName() => $token]);
    }

}