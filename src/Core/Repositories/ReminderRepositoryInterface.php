<?php namespace Metin2CMS\Core\Repositories;

interface ReminderRepositoryInterface {

    /**
     * Generate a reminder
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Find reminder by token
     *
     * @param $token
     * @return mixed
     */
    public function findByToken($token);

    /**
     * Find reminder by user
     *
     * @param $username
     * @return mixed
     */
    public function findByUser($username);

    /**
     * Delete reminder by token
     *
     * @param $token
     * @return mixed
     */
    public function deleteByToken($token);

    /**
     * Delete reminder by username
     *
     * @param $username
     * @return mixed
     */
    public function deleteByUser($username);
}