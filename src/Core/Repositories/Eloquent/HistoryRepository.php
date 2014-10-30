<?php namespace Metin2CMS\Core\Repositories\Eloquent;

use Carbon\Carbon;
use Metin2CMS\Core\Entities\History;
use Metin2CMS\Core\Repositories\HistoryRepositoryInterface;

class HistoryRepository extends AbstractRepository implements HistoryRepositoryInterface {

    /**
     * @param History $model
     */
    public function __construct(History $model)
    {
        $this->model = $model;
    }

    /**
     * Create account event
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $event = $this->getNew();
        $event->account_id = $data['account'];
        $event->event_type = $data['event'];
        $event->data = $data['data'];
        $event->created_at = Carbon::now()->toDateTimeString();
        $event->save();

        return $this->toArray($event);
    }

    /**
     * Find account history by id
     *
     * @param $id
     * @return mixed
     */
    public function findByAccount($id)
    {
        return $this->toArray($this->model->where('account_id', $id)->get());
    }
}