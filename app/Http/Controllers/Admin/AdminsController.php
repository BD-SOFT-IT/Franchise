<?php

namespace App\Http\Controllers\Admin;

use App\Mail\Admin\AdminCreated;
use App\Models\Admin;
use App\Models\AdminRole;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AdminsController extends Controller
{
    public function __construct() {
        $this->middleware(['admin', 'checkSA', 'auth:admin']);
        $this->middleware('can:manage-admin')->except(['delete']);
        $this->middleware('can:delete-admin')->only(['delete']);
    }

    public function index() {
        $ids = AdminRole::whereIn('ar_name', ['alpha', 'franchise'])
            ->get(['ar_id'])
            ->toArray();

        $admins = Admin::where('id', '<>', auth('admin')->id())
            ->whereNotIn('role_id', $ids)
            ->orderBy('first_name')
            ->select(['admins.name', 'admins.email', 'admins.mobile_primary', 'admins.role_id', 'admins.id'])
            ->get();
        return view('admin.admin-controls.index')
            ->with([
                'admins'    => $admins
            ]);
    }

    public function show($id) {
        $admin = Admin::findOrFail($id);

        return view('admin.admin-controls.show')
            ->with('admin', $admin);
    }

    public function add() {
        if(auth('admin')->user()->isSuperAdmin()) {
            $roles = AdminRole::whereNotIn('ar_name', ['alpha', 'shipper', 'franchise'])
                ->orderBy('ar_title')
                ->get();
        }
        else {
            $roles = AdminRole::whereNotIn('ar_name', ['super_admin', 'alpha', 'shipper', 'franchise'])
                ->orderBy('ar_title')
                ->get();
        }

        return view('admin.admin-controls.create')
            ->with([
                'roles' => $roles
            ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     * @throws AuthorizationException
     */
    public function store(Request $request) {
        $this->validator($request);

        $role = AdminRole::find($request->post('role_id'));
        if(!$role) {
            abort(404);
        }
        if($role->ar_name == 'super_admin') {
            $this->authorize('create-super-admin');
        }

        $admin = $this->create($request->all());
        Mail::to($admin)->send(new AdminCreated($admin, $request->post('password')));

        return redirect()
            ->route('admin.admins.all')
            ->with('status', 'New Admin created successfully..!!!');
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

    /**
     * @param Request $request
     * @param $id
     * @return Factory|RedirectResponse|View
     * @throws AuthorizationException
     * @throws ValidationException
     */
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
            'mobile_primary' => 'required|min:10',
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

        if($request->post('password') != null && strlen($request->post('password')) >= 8) {
            $admin->password = Hash::make($request->post('password'));
        }
        $admin->save();
        return redirect()->back()->with([
            'update_status' => true
        ]);
    }

    public function delete(Request $request) {
        $admin = Admin::find($request->post('id'));
        if(!$admin) {
            return redirect()
                ->route('admin.admins.all')
                ->with([
                    'status' => 'Admin not found!'
                ]);
        }
        if(!$admin->delete()) {
            return redirect()
                ->route('admin.admins.all')
                ->with([
                    'status' => 'Something went wrong! Please try again later.'
                ]);
        }
        return redirect()
            ->route('admin.admins.all')
            ->with([
                'status' => 'Admin deleted successfully.!'
            ]);
    }

    /**
     * @param Request $request
     * @throws ValidationException
     */
    protected function validator(Request $request) {
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:191|unique:admins',
            'password' => 'required|string|min:8|confirmed',
            'mobile_primary' => 'required|min:10',
            'role_id' => 'numeric|required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Admin
     */
    protected function create(array $data)
    {
        $admin = new Admin();

        $admin->first_name = $data['first_name'];
        $admin->last_name = $data['last_name'];
        $admin->name = $data['first_name'] . ' ' . $data['last_name'];
        $admin->email = $data['email'];
        $admin->password = Hash::make($data['password']);
        $admin->mobile_primary = $data['mobile_primary'];
        $admin->role_id = $data['role_id'];
        $admin->active = true;

        if(!$admin->save()) {
            abort(500);
        }
        return $admin;
    }

}
