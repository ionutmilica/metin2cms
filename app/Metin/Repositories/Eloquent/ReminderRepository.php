<?php

namespace Metin\Repositories\Eloquent;

use Metin\Entities\Reminder;
use Metin\Repositories\ReminderRepositoryInterface;

class ReminderRepository extends AbstractRepository implements ReminderRepositoryInterface {

    public function __construct(Reminder $model)
    {
        $this->model = $model;
    }


    public function generatePassword(array $data, $token, $password)
    {
        $account           = $this->getNew();
        $account->username = $data['username'];
        $account->token    = $token;
        $account->password = $passord;
        $account->save();
    }
} 