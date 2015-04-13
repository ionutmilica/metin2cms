<?php namespace Metin2CMS\Repositories;

interface AccountMetaRepositoryInterface {

    /**
     * Get meta by account id and key
     *
     * @param $accountId
     * @param $metaKey
     * @return mixed
     */
    public function get($accountId, $metaKey);

    /**
     * Set meta to an account
     *
     * @param $accountId
     * @param $metaKey
     * @param $metaValue
     * @return mixed
     */
    public function set($accountId, $metaKey, $metaValue);
}