<?php

namespace Metin\Repositories\Eloquent;

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
        $account->save();

        return $this->toArray($account);
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
} 