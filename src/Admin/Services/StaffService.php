<?php namespace Metin2CMS\Admin\Services;

use Metin2CMS\Core\Repositories\StaffRepositoryInterface;

class StaffService {
    /**
     * @var StaffRepositoryInterface
     */
    private $staff;

    /**
     * @param StaffRepositoryInterface $staff
     */
    public function __construct(StaffRepositoryInterface $staff)
    {
        $this->staff = $staff;
    }

    /**
     * Get all staff members
     *
     * @param array $data
     * @return mixed
     */
    public function search(array $data)
    {
        return $this->staff->all();
    }

    /**
     * Delete staff member
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $staff = $this->staff->findById($id);

        if ($staff['grade'] == 'IMPLEMENTOR')
        {
            return false;
        }

        return $this->staff->delete($id);
    }
}