<?php

namespace Metin\Repositories\Eloquent;

use Illuminate\Auth\UserInterface;
use Metin\Entities\Account;
use Metin\Repositories\AccountRepositoryInterface;

class AccountRepository extends AbstractRepository implements AccountRepositoryInterface {

    public function __construct(Account $model)
    {
        $this->model = $model;
    }

    public function findById($id)
    {
        return $this->toArray($this->model->find($id));
    }

    public function findByName($name)
    {
        return $this->toArray($this->model->where('login', $name)->first());
    }

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

    public function changePassword(array $data)
    {
        $account = $this->model->where('login', $data['username']);
        
        $update = $account->update(array(
            'password' => $data['password']
        ));

        if ($update)
        {
            return true;
        }
    }
} 