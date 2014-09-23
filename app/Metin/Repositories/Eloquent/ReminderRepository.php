<?php

namespace Metin\Repositories\Eloquent;

use Metin\Entities\Reminder;
use Metin\Repositories\ReminderRepositoryInterface;

class ReminderRepository extends AbstractRepository implements ReminderRepositoryInterface {

    public function __construct(Reminder $model)
    {
        $this->model = $model;
    }

    public function findByToken($token)
    {
        return $this->toArray($this->model->where('token', $token)->first());
    }

    public function generatePassword(array $data, $token, $password)
    {
        $account           = $this->getNew();
        $account->username = $data['username'];
        $account->token    = $token;
        $account->password = $password;
        $account->save();

        return true;
    }

    public function deleteToken($token)
    {
        return $this->model->where('token', $token)->delete();
    }
} 