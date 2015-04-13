<?php namespace Metin2CMS\Repositories\Eloquent;

use Carbon\Carbon;
use Metin2CMS\Entities\Account;
use Metin2CMS\Repositories\AccountRepositoryInterface;

class AccountRepository extends AbstractRepository implements AccountRepositoryInterface {

    /**
     * @param Account $model
     */
    public function __construct(Account $model)
    {
        $this->model = $model;
    }

    /**
     * Get all accounts
     *
     * @return mixed
     */
    public function all()
    {
        return $this->toArray($this->model->all());
    }

    /**
     * Returns all accounts with pagination
     *
     * @param array $data
     * @param int $perPage
     * @return mixed
     */
    public function search(array $data, $perPage = 10)
    {
        $model = $this->getNew();

        if (isset($data['perPage']))
        {
            $perPage = (int) $data['perPage'] < 1 || (int) $data['perPage'] > 10 ? 10 : $data['perPage'];
        }

        if (isset($data['username']))
        {
            $username = dbEscape($data['username']);

            $model = $model->where('login', 'LIKE', '%'.$username.'%');
        }

        if (isset($data['email']))
        {
            $email = dbEscape($data['email']);

            $model = $model->where('email', 'LIKE', '%'.$email.'%');
        }
        return $model->paginate($perPage);
    }

    /**
     * Find user by id
     *
     * @param $id
     * @return bool
     */
    public function findById($id)
    {
        return $this->toArray($this->model->find($id));
    }

    /**
     * Find user by name
     *
     * @param $name
     * @return bool
     */
    public function findByName($name)
    {
        return $this->toArray($this->model->where('login', $name)->first());
    }

    /**
     * Find an account by id if the provided value is integer
     *
     * @param $key
     * @return bool
     */
    public function findByIdOrName($key)
    {
        return is_int($key) ? $this->findById($key) : $this->findByName($key);
    }

    /**
     * Create a new user
     *
     * @param array $info
     * @return bool
     */
    public function create(array $info)
    {
        $account = $this->getNew();
        $account->login = $info['login'];
        $account->email = $info['email'];
        $account->password = $info['password'];
        $account->status = $info['status'];

        if (isset($info['confirmation_token'])) // Think about it
        {
            $account->confirmation_token = $info['confirmation_token'];
        }

        $account->save();

        return $this->toArray($account);
    }

    /**
     * @param $conditions
     * @param array $info
     * @return mixed
     */
    public function update($conditions, array $info)
    {
        $account = $this->getNew();

        foreach ($conditions as $field => $value)
        {
            $account = $account->where($field, $value);
        }

        return $this->toArray($account->update($info));
    }

    /**
     * Change password for user
     *
     * @param array $username
     * @param $password
     * @internal param array $data
     * @return bool
     */
    public function changePassword($username, $password)
    {
        $account = $this->model->where('login', $username);
        
        return $this->toArray($account->update(array(
            'password' => $password
        )));
    }

    /**
     * Check if an account is blocked for a given username/id
     *
     * @param $key
     * @return mixed
     */
    public function isBlocked($key)
    {
        $account = $this->findByIdOrName($key);

        if ( ! $account) return false;

        $date = new Carbon($account['availDt']);

        return $this->toArray($date->timestamp > Carbon::now()->timestamp);
    }

    /**
     * Check if an account is disabled(not confirmed) for a given username/id
     *
     * @param $key
     * @return mixed
     */
    public function isDisabled($key)
    {
        $account = $this->findByIdOrName($key);

        if ( ! $account) return false;

        return $this->toArray($account['status'] !== 'OK');
    }

    /**
     * Get user hashed password
     *
     * @param $id
     * @return string
     */
    public function authPassword($id)
    {
        return $this->toArray($this->model->find($id)->getAuthPassword());
    }

    /**
     * Change email for a user
     *
     * @param $key
     * @param $email
     * @internal param array $data
     * @return mixed
     */
    public function changeEmail($key, $email)
    {
        $account = $this->whereIdOrName($key);

        return $this->toArray($account->update(array(
            'email' => $email
        )));
    }

    /**
     * Helper method using to auto-detect username or id from the value
     *
     * @param $key
     * @return mixed
     */
    protected function whereIdOrName($key)
    {
        $field = is_int($key) ? 'id' : 'login';

        return $this->model->where($field, $key);
    }
} 