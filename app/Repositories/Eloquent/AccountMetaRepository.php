<?php namespace Metin2CMS\Repositories\Eloquent;

use Metin2CMS\Entities\AccountMeta;
use Metin2CMS\Repositories\AccountMetaRepositoryInterface;

class AccountMetaRepository extends AbstractRepository implements AccountMetaRepositoryInterface {

    /**
     * @param AccountMeta $model
     */
    public function __construct(AccountMeta $model)
    {
        $this->model = $model;
    }

    /**
     * Get meta value for account & meta-key
     *
     * @param $account
     * @param $metaKey
     * @return mixed
     */
    public function get($account, $metaKey)
    {
        $value = $this->model->where('account_id', $account)
                      ->where('meta_key', $metaKey)
                      ->first(array('meta_value'));

        if ( ! $value ) return false;

        $value = $value->toArray();

        return $value['meta_value'];
    }

    /**
     * Set meta key-value to account
     *
     * @param $accountId
     * @param $metaKey
     * @param $metaValue
     * @param int $metaType
     * @return mixed
     */
    public function set($accountId, $metaKey, $metaValue, $metaType = 0)
    {
        $meta = $this->model->where('account_id', $accountId)
                            ->where('meta_key', $metaKey)->first();
        $meta = $meta ?: $this->getNew();

        $meta->account_id = $accountId;
        $meta->meta_key = $metaKey;
        $meta->meta_value = $metaValue;
        $meta->save();

        return $this->toArray($meta);
    }
}