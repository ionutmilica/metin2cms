<?php namespace Metin2CMS\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Metin2CMS\Http\Requests\Admin\CreateStaffRequest;
use Metin2CMS\Services\Admin\StaffService;

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
     * Add a new staff member form
     *
     * @return mixed
     */
    public function createForm()
    {
        return $this->view('staff.create');
    }

    /**
     * Add a new staff member
     *
     * @param CreateStaffRequest $request
     * @return mixed
     * @throws \Metin2CMS\Admin\Exceptions\CreateFailedException
     */
    public function doCreate(CreateStaffRequest $request)
    {
        $input = Input::only('account', 'player', 'grade');

        $this->staff->create($input);

        return Redirect::route('admin.staff.index');
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
