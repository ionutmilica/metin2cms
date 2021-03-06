<?php namespace Metin2CMS\Repositories\Eloquent;


use Illuminate\Support\Facades\DB;
use Metin2CMS\Entities\Staff;
use Metin2CMS\Repositories\StaffRepositoryInterface;

class StaffRepository extends AbstractRepository implements StaffRepositoryInterface {

    /**
     * @param Staff $model
     */
    public function __construct(Staff $model)
    {
        $this->model = $model;
    }

    /**
     * Get all staff members
     *
     * @return mixed
     */
    public function all()
    {
        $fluent = $this->fluentQuery();

        return $this->model->hydrate($fluent->get())->toArray();
    }

    /**
     * Add account & player to the staff
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $staffMember = $this->getNew();
        $staffMember->mName = $data['player'];
        $staffMember->mAccount = $data['account'];
        $staffMember->mAuthority = $data['grade'];
        $staffMember->save();

        return $this->toArray($staffMember);
    }

    /**
     * Find staff member by id
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        $fluent = $this->fluentQuery();
        $fluent->where('mID', $id);

        return $this->toArray($fluent->first());
    }

    /**
     * @param $account
     * @return mixed
     */
    public function findByAccount($account)
    {
        $fluent = $this->fluentQuery();
        $fluent->where('mAccount', $account);

        return $this->toArray($fluent->first());
    }

    /**
     * Find staff member by player
     *
     * @param $name
     * @return mixed
     */
    public function findByPlayer($name)
    {
        $fluent = $this->fluentQuery();
        $fluent->where('mName', $name);

        return $this->toArray($fluent->first());
    }

    /**
     * Delete an staff member
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->toArray($this->model->where('mID', $id)->delete());
    }

    /**
     * Generate an eloquent query
     *
     * @return mixed
     */
    protected function fluentQuery()
    {
        $connection = $this->model->getConnectionName();

        return DB::connection($connection)->table('gmlist')
                    ->join('account.account', 'gmlist.mAccount', '=', 'account.login')
                    ->select('mID as id', 'account.id as account_id', 'login as username', 'mName as player_name', 'mAuthority as grade');
    }
}