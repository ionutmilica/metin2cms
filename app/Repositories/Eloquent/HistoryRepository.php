<?php namespace Metin2CMS\Repositories\Eloquent;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Metin2CMS\Entities\History;
use Metin2CMS\Repositories\HistoryRepositoryInterface;

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
        $query = DB::connection($this->model->getConnectionName())->table('history')
                    ->select(array('login as account_name', 'created_at', 'data', 'account_id', 'event_type'))
                    ->join('account', 'history.account_id', '=', 'account.id')
                    ->where('account_id', $id);

        return $this->toArray($this->model->hydrate($query->get()));
    }
}