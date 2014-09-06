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
        return $this->toArray($this->model->create($account));
    }
} 