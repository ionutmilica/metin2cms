<?php namespace Metin2CMS\Site\Repositories\Eloquent;

use Metin2CMS\Site\Entities\Reminder;
use Metin2CMS\Site\Repositories\ReminderRepositoryInterface;

class ReminderRepository extends AbstractRepository implements ReminderRepositoryInterface {

    /**
     * @param Reminder $model
     */
    public function __construct(Reminder $model)
    {
        $this->model = $model;
    }

    /**
     * Find password reminder by token
     *
     * @param $token
     * @return bool
     */
    public function findByToken($token)
    {
        return $this->toArray($this->model->where('token', $token)->first());
    }

    /**
     * Creates the password reminder
     *
     * @param array $data
     * @param $token
     * @param $password
     * @return bool
     */
    public function generatePassword(array $data, $token, $password)
    {
        $account           = $this->getNew();
        $account->username = $data['username'];
        $account->token    = $token;
        $account->password = $password;
        $account->save();

        return true;
    }

    /**
     * Deletes the the password reminder
     *
     * @param $token
     * @return mixed
     */
    public function deleteToken($token)
    {
        return $this->model->where('token', $token)->delete();
    }
} 