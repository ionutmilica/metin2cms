<?php

namespace Metin\Repositories\Eloquent;

use Carbon\Carbon;
use Illuminate\Auth\UserInterface;
use Metin\Entities\Account;
use Metin\Repositories\AccountRepositoryInterface;

class AccountRepository extends AbstractRepository implements AccountRepositoryInterface {

    /**
     * @param Account $model
     */
    public function __construct(Account $model)
    {
        $this->model = $model;
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
        $account->login = $info['username'];
        $account->email = $info['email'];
        $account->password = $info['password'];
        $account->status = $info['status'];
        $account->confirmation_token = $info['confirmation_token'];

        $account->save();

        return $this->toArray($account);
    }

    public function update($conditions, array $info)
    {
        $account = $this->getNew();

        foreach ($conditions as $field => $value)
        {
            $account->where($field, $value);
        }

        return $this->toArray($account->update($info));
    }

    /**
     * Change password for user
     *
     * @param array $data
     * @return bool
     */
    public function changePassword(array $data)
    {
        $account = $this->model->where('login', $data['username']);
        
        return $this->toArray($account->update(array(
            'password' => $data['password']
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