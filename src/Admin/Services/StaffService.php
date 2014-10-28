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
}