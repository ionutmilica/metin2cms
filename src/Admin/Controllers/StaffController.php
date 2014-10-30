<?php namespace Metin2CMS\Admin\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Metin2CMS\Admin\Services\StaffService;
use Metin2CMS\Admin\Forms\Staff\Create;

class StaffController extends BaseController {
    /**
     * @var StaffService
     */
    private $staff;

    /**
     * @var Create
     */
    protected $createForm;

    /**
     * @param StaffService $staff
     * @param Create $createForm
     */
    public function __construct(StaffService $staff, Create $createForm)
    {
        $this->staff = $staff;
        $this->createForm = $createForm;
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

    public function doCreate()
    {
        $input = Input::only('account', 'player', 'grade');

        $this->createForm->validate($input);

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
