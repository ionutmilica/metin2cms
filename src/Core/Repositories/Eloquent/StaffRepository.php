<?php namespace Metin2CMS\Core\Repositories\Eloquent;


use Metin2CMS\Core\Entities\Staff;
use Metin2CMS\Core\Repositories\StaffRepositoryInterface;

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
        return $this->toArray($this->model->all());
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
     * Get safebox by account id
     *
     * @param $id
     * @return mixed
     */
    public function findByAccount($id)
    {
        return $this->toArray($this->model->where('mAccount', $id)->first());
    }

    /**
     * Find staff member by player
     *
     * @param $name
     * @return mixed
     */
    public function findByPlayer($name)
    {
        return $this->toArray($this->model->where('mName', $name)->first());
    }
}