<?php namespace Metin2CMS\Repositories\Eloquent;

use Metin2CMS\Entities\Safebox;
use Metin2CMS\Repositories\SafeboxRepositoryInterface;

class SafeboxRepository extends AbstractRepository implements SafeboxRepositoryInterface {

    /**
     * @param Safebox $model
     */
    public function __construct(Safebox $model)
    {
        $this->model = $model;
    }

    /**
     * Get safebox by account id
     *
     * @param $id
     * @return mixed
     */
    public function findByAccount($id)
    {
        return $this->toArray($this->model->where('account_id', $id)->first());
    }
}