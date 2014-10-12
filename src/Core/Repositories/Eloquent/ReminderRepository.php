<?php namespace Metin2CMS\Core\Repositories\Eloquent;

use Metin2CMS\Core\Entities\Reminder;
use Metin2CMS\Core\Repositories\ReminderRepositoryInterface;

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
     * Find reminder by account name
     *
     * @param $name
     * @return mixed
     */
    public function findByUser($name)
    {
        return $this->toArray($this->model->where('username', $username)->first());
    }
    /**
     * Creates the password reminder
     *
     * @param array $data
     * @param $token
     * @param $password
     * @return bool
     */
    public function create(array $data, $token, $password)
    {
        $account           = $this->getNew();
        $account->username = $data['username'];
        $account->token    = $token;
        $account->password = $password;
        $account->save();

        return $this->toArray($account);
    }

    /**
     * Deletes the the password reminder
     *
     * @param $token
     * @return mixed
     */
    public function deleteByToken($token)
    {
        return $this->model->where('token', $token)->delete();
    }

    /**
     * Delete reminder by user
     *
     * @param $username
     * @return mixed
     */
    public function deleteByUser($username)
    {
        return $this->model->where('username', $username)->delete();
    }
} 