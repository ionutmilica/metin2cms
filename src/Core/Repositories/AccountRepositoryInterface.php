<?php namespace Metin2CMS\Core\Repositories;

interface AccountRepositoryInterface {

    /**
     * Create account
     *
     * @param array $info
     * @return mixed
     */
    public function create(array $info);

    /**
     * Get all accounts
     *
     * @return array
     */
    public function all();

    /**
     * Find account by id
     *
     * @param $id
     * @return mixed
     */
    public function findById($id);

    /**
     * Find account by username
     *
     * @param $login
     * @return mixed
     */
    public function findByName($login);

    /**
     * Find account by id or name checking if the key is int or string
     *
     * @param $key
     * @return mixed
     */
    public function findByIdOrName($key);

    /**
     * Change the password of an account
     *
     * @param array $data
     * @return mixed
     */
    public function changePassword(array $data);
}