<?php

namespace App\Http\Controllers\Admin;

use App\Mail\Admin\AdminCreated;
use App\Mail\Admin\FranchiseCreated;
use App\Models\Admin;
use App\Models\AdminRole;
use App\Notifications\FranchiseApprovedEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class FranchiseController extends Controller
{
    public function __construct() {
        $this->middleware(['admin', 'checkSA', 'auth:admin']);
        $this->middleware('can:manage-franchise');
    }

    public function all() {
        return view('admin.franchise-controls.index');
    }

    public function show($id) {
        $franchise = Admin::find($id);
        if(!$franchise) {
            return view('admin.franchise-controls.show')
                ->with('error', 'Not Found');
        }

        return view('admin.franchise-controls.show')
            ->with('franchise', $franchise);
    }

    public function create() {
        return view('admin.franchise-controls.create');
    }

    public function store(Request $request) {
        $this->validator($request);

        $admin = $this->createFranchise($request->all());

        Mail::to($admin)->send(new FranchiseCreated($admin, $request->post('password')));

        return redirect()
            ->route('admin.franchise-control.all')
            ->with('status', 'New Franchise created successfully..!!!');
    }

    public function edit($id) {
        $franchise = AdminRole::whereArName('franchise')
            ->firstOrFail()
            ->admins()
            ->findOrFail($id);

        return view('admin.franchise-controls.edit')
            ->with([
                'admin' => $franchise
            ]);
    }

    public function update(Request $request, $id) {
        $franchise = AdminRole::whereArName('franchise')
            ->firstOrFail()
            ->admins()
            ->findOrFail($id);

        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:191',
            'password' => 'nullable|string|min:6|confirmed',
            'mobile_primary' => 'required|min:10'
        ]);
        if($request->post('email') != $franchise->email) {
            $this->validate($request, [
                'email' => 'unique:admins'
            ]);
        }

        $franchise->first_name = $request->post('first_name');
        $franchise->last_name = $request->post('last_name');
        $franchise->name = $request->post('first_name') . ' ' . $request->post('last_name');
        $franchise->email = $request->post('email');
        $franchise->mobile_primary = $request->post('mobile_primary');

        if($request->post('password') != null && strlen($request->post('password')) >= 6) {
            $franchise->password = Hash::make($request->post('password'));
        }
        $franchise->save();
        return redirect()->back()->with([
            'update_status' => true
        ]);
    }

    public function activate($id) {
        $franchise = Admin::find($id);
        if(!$franchise) {
            return redirect()->back()->with('status', 'Franchise Not Found!');
        }

        $franchise->active = true;
        $franchise->save();

        $franchise->notify(new FranchiseApprovedEmail());

        return redirect()->back()->with('status', 'Franchise Activated!');
    }
    public function deactivate($id) {
        $franchise = Admin::find($id);
        if(!$franchise) {
            return redirect()->back()->with('status', 'Franchise Not Found!');
        }

        $franchise->active = false;
        $franchise->save();

        return redirect()->back()->with('status', 'Franchise Deactivated!');
    }


    protected function validator(Request $request) {
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:191|unique:admins',
            'password' => 'required|string|min:6|confirmed',
            'mobile_primary' => 'required|min:10'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Admin
     */
    protected function createFranchise(array $data)
    {
        $role = AdminRole::whereArName('franchise')->firstOrFail();
        $admin = new Admin();

        $admin->first_name = $data['first_name'];
        $admin->last_name = $data['last_name'];
        $admin->name = $data['first_name'] . ' ' . $data['last_name'];
        $admin->email = $data['email'];
        $admin->password = Hash::make($data['password']);
        $admin->mobile_primary = mobileNumberForStore($data['mobile_primary']);
        $admin->role_id = $role->ar_id;
        $admin->active = 1;
        $admin->franchise_id = 'FRA' . mt_rand(100000, 999999);

        if(!$admin->save()) {
            abort(500);
        }
        return $admin;
    }
}
