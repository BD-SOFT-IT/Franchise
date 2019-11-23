<?php

namespace App\Http\Controllers\Admin;

use App\Mail\Admin\AdminCreated;
use App\Models\Admin;
use App\Models\AdminRole;
use App\Models\Shipper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;


class ShipperController extends Controller
{
    public function __construct() {
        $this->middleware(['admin', 'checkSA', 'auth:admin']);
        $this->middleware('can:manage-shipper');
    }

    public function index() {
        $shippers = Shipper::all();

        return view('admin.shippers.index')
            ->with([
                'admins'    => $shippers
            ]);
    }

    public function show($id) {

    }

    public function add() {
        $shipperRole = AdminRole::whereArName('shipper')->first();

        return view('admin.shippers.create')
            ->with([
                'role' => $shipperRole
            ]);
    }



    public function edit($id) {
        $admin = Admin::find($id);
        if(!$admin) {
            return view('admin.admin-controls.edit')
                ->with([
                    'not_found' => true
                ]);
        }
        if(auth('admin')->user()->isSuperAdmin()) {
            $roles = AdminRole::orderBy('ar_title')
                ->get();
        }
        else {
            $roles = AdminRole::whereNotIn('ar_name', ['super_admin'])
                ->orderBy('ar_title')
                ->get();
        }
        return view('admin.admin-controls.edit')
            ->with([
                'admin' => $admin,
                'roles' => $roles
            ]);
    }

    public function update(Request $request, $id) {
        $admin = Admin::find($id);
        if(!$admin) {
            return view('admin.admin-controls.edit')
                ->with([
                    'not_found' => true
                ]);
        }
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:191',
            'password' => 'nullable|string|min:6|confirmed',
            'mobile_primary' => ['required', 'regex:/^(?:\+880|880|01|1)?(?:\d{11}|\d{13}|\d{10})$/i'],
            'role_id' => 'numeric|required'
        ]);
        if($request->post('email') != $admin->email) {
            $this->validate($request, [
                'email' => 'unique:admins'
            ]);
        }

        $role = AdminRole::find($request->post('role_id'));
        if(!$role) {
            abort(404);
        }
        if($admin->role->ar_name == 'super_admin' || $role->ar_name == 'super_admin') {
            $this->authorize('create-super-admin');
        }

        $admin->first_name = $request->post('first_name');
        $admin->last_name = $request->post('last_name');
        $admin->name = $request->post('first_name') . ' ' . $request->post('last_name');
        $admin->email = $request->post('email');
        $admin->mobile_primary = $request->post('mobile_primary');
        $admin->role_id = $request->post('role_id');

        if($request->post('password') != null && count($request->post('password')) >= 6) {
            $admin->password = Hash::make($request->post('password'));
        }
        $admin->save();
        return redirect()->back()->with([
            'update_status' => true
        ]);
    }

    public function delete(Request $request) {
        $admin = Shipper::find($request->post('id'));
        if(!$admin) {
            return redirect()
                ->route('admin.admins.all')
                ->with([
                    'status' => 'Shipper not found!'
                ]);
        }
        if($admin->shipper_user_id !== null) {
            $admin->admin()->delete();
        }
        if(!$admin->delete()) {
            return redirect()
                ->route('admin.shipper.all')
                ->with([
                    'status' => 'Something went wrong! Please try again later.'
                ]);
        }
        return redirect()
            ->route('admin.shipper.all')
            ->with([
                'status' => 'Shipper deleted successfully.!'
            ]);
    }

    /**
     * @param Request $request
     * @throws ValidationException
     */
    protected function validator(Request $request) {
        $this->validate($request, [
            'shipper_first_name' => 'required|string|max:255',
            'shipper_last_name' => 'required|string|max:255',
            'email' => 'required|email|max:191|unique:admins',
            'shipper_password' => 'required|string|min:6|confirmed',
            'mobile_primary' => ['required', 'regex:/^(?:\+880|880|01|1)?(?:\d{11}|\d{13}|\d{10})$/i']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @param int $role_id
     * @return \App\Models\Admin
     */
    protected function create(array $data, int $role_id)
    {
        $admin = new Admin;

        $admin->first_name = $data['shipper_first_name'];
        $admin->last_name = $data['shipper_last_name'];
        $admin->name = $data['shipper_first_name'] . ' ' . $data['shipper_last_name'];
        $admin->email = $data['email'];
        $admin->password = Hash::make($data['shipper_password']);
        $admin->mobile_primary = mobileNumberForStore($data['mobile_primary']);
        $admin->role_id = $role_id;
        $admin->address = $data['shipper_address'];
        $admin->active = 1;

        if(!$admin->save()) {
            abort(500);
        }
        return $admin;
    }

    protected function createShipper(Request $request, int $admin_id = null) {
        $shipper = new Shipper();

        $shipper->shipper_user_id = $admin_id;
        $shipper->shipper_name = $request->post('shipper_first_name') . ' ' . $request->post('shipper_last_name');
        $shipper->shipper_company = $request->post('shipper_company');
        $shipper->shipper_website = $request->post('shipper_website');
        $shipper->shipper_address = $request->post('shipper_address');
        $shipper->shipper_email = $request->post('email');
        $shipper->shipper_phone = mobileNumberForStore($request->post('mobile_primary'));

        return $shipper->save();
    }
}
