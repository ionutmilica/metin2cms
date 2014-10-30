<?php namespace Metin2CMS\Admin\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Metin2CMS\Admin\Services\StaffService;

class StaffController extends BaseController {
    /**
     * @var StaffService
     */
    private $staff;

    /**
     * @param StaffService $staff
     */
    public function __construct(StaffService $staff)
    {
        $this->staff = $staff;
    }

    /**
     * List all staff members
     *
     * @return mixed
     */
    public function index()
    {
        $staff = $this->staff->search(Input::all());

        return $this->view('staff.index', compact('staff'));
    }

    /**
     * @return mixed
     */
    public function createForm()
    {
        return $this->view('staff.create');
    }

    /**
     * Remove a staff member
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $this->staff->delete($id);

        return Redirect::route('admin.staff.index');
    }
}
