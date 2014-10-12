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
     * Update the account
     *
     * @param $conditions
     * @param array $data
     * @return mixed
     */
    public function update($conditions, array $data);

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
     * Check if an account is disabled
     *
     * @param $user
     * @return mixed
     */
    public function isDisabled($user);

    /**
     * Check if an account is blocked
     *
     * @param $user
     * @return mixed
     */
    public function isBlocked($user);

    /**
     * Change the password of an account
     *
     * @param $user
     * @param $password
     * @internal param array $data
     * @return mixed
     */
    public function changePassword($user, $password);

    /**
     * Change the email
     *
     * @param $user
     * @param $email
     * @return mixed
     */
    public function changeEmail($user, $email);
}