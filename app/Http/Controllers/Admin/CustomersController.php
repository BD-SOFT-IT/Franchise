<?php

namespace App\Http\Controllers\Admin;

use App\Mail\Admin\ClientCreated;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class CustomersController extends Controller
{
    public function __construct() {
        $this->middleware('can:manage-customers');
    }

    public function index() {
        $clients = Client::count();
        return view('admin.customers.index')
            ->with('clients', $clients);
    }

    public function show($id) {
        if(!auth('admin')->user()->isAlpha() && !auth('admin')->user()->isSuperAdmin() && !auth('admin')->user()->isAdmin()) {
            return redirect()->back()->with('status', 'You are not authorised!');
        }
        $client = Client::find($id);
        if(!$client) {
            return view('admin.customers.show')
                ->with('notFound', 'Requested Customer Not Found!');
        }
        return view('admin.customers.show')
            ->with('client', $client);
    }

    public function add() {
        return view('admin.customers.add');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request) {
        if($msg = $this->validator($request)) {
            return redirect()->back()->withInput()->withErrors($msg);
        }

        $client = new Client();
        $client->first_name = $request->post('first_name');
        $client->last_name = $request->post('last_name');
        $client->email = $request->post('email');
        $client->mobile = mobileNumberForStore($request->post('mobile'));
        $client->password = Hash::make($request->post('password'));
        $client->email_verified_at = Carbon::now();

        if(!$client->save()) {
            abort(500);
        }
        if($client->email) {
            Mail::to($client)->send(new ClientCreated($client, $request->post('password')));
        }
        if($client->mobile) {
            $msg = "Account Created Successfully!\nPassword: " . $request->post('password') . "\n-" . getSiteBasic('site_title');
            mobileSms($client->mobile, $msg);
        }

        return redirect()
            ->route('admin.customers')
            ->with('status', 'New Client created successfully..!!!');
    }

    /**
     * @param Request $request
     * @return null|MessageBag
     */
    protected function validator(Request $request) {
        $data = $request->all();
        $mobile = $request->post('mobile');
        if($mobile) {
            $data['mobile'] = mobileNumberForStore($request->post('mobile'));
        }

        $validator = Validator::make($data, [
            'first_name'    => ['required', 'string', 'max:255'],
            'last_name'     => ['required', 'string', 'max:255'],
            'email'         => ['nullable', 'email', 'max:191', 'unique:clients'],
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
            'mobile'        => ['required', 'regex:/^(?:\+880|880|01|1)?(?:\d{11}|\d{13}|\d{10})$/i', 'unique:clients']
        ], [
            'mobile.regex' => 'Enter valid BD format, eg: 8801234567890 or 01234567890'
        ]);
        if($validator->fails()) {
            return $validator->messages();
        }
        return null;
    }
}
