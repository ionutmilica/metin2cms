<?php namespace Metin2CMS\Core\Repositories;

interface HistoryRepositoryInterface {

    /**
     * Create a new event for the account
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Find account events
     *
     * @param $id
     * @return mixed
     */
    public function findByAccount($id);
}