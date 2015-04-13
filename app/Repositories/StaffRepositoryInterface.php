<?php namespace Metin2CMS\Repositories;

interface StaffRepositoryInterface {

    /**
     * Get all staff members
     *
     * @return mixed
     */
    public function all();

    /**
     * Delete an staff member
     *
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Add account & player to the staff list
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Find staff member by id
     *
     * @param $id
     * @return mixed
     */

    public function findById($id);
    /**
     * Find staff member by account name
     *
     * @param $name
     * @return mixed
     */
    public function findByAccount($name);

    /**
     * Find staff member by player name
     *
     * @param $name
     * @return mixed
     */
    public function findByPlayer($name);
}