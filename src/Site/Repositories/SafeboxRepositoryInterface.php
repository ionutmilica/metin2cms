<?php namespace Metin2CMS\Site\Repositories;

interface SafeboxRepositoryInterface {

    /**
     * Get safebox by account id
     *
     * @param $id
     * @return mixed
     */
    public function findByAccount($id);
}