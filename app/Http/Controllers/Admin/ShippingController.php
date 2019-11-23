<?php

namespace App\Http\Controllers\Admin;

use App\Mail\Admin\AdminCreated;
use App\Models\Admin;
use App\Models\AdminRole;
use App\Models\DeliveryMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;


class ShippingController extends Controller
{
    public function __construct() {
        $this->middleware(['admin', 'checkSA', 'auth:admin']);
        $this->middleware('can:manage-shipper');
    }

    public function index() {
        $methods = DeliveryMethod::whereMethodActive(true)->orderBy('method_name')->get();

        return view('admin.shipping-method.index')
            ->with([
                'methods'    => $methods
            ]);
    }

    public function show($id) {

    }

    public function add() {
        return view('admin.shipping-method.create');
    }

    public function store(Request $request) {
        $this->validator($request);

        $method = new DeliveryMethod();

        $method->method_name = $request->post('method_name');
        $method->method_charge = $request->post('method_charge');
        $method->method_time = $request->post('method_time');
        $method->method_note = $request->post('method_note');
        $method->method_available_outside = $request->post('method_available_outside');
        $method->method_active = $request->post('method_active');

        if(!$method->save()) {
            return redirect()
                ->back()->withInput()
                ->with([
                    'status' => 'Something went wrong! Please try again later.'
                ]);
        }
        return redirect()
            ->route('admin.shipping')
            ->with([
                'status' => 'Method added successfully.!'
            ]);
    }


    public function edit($id) {
        $method = DeliveryMethod::find($id);
        if(!$method) {
            return redirect()->back()
                ->with([
                    'status' => 'Method Not Found!'
                ]);
        }

        return view('admin.shipping-method.edit')
            ->with([
                'method'    => $method
            ]);
    }

    public function update(Request $request, $id) {
        $method = DeliveryMethod::find($id);
        if(!$method) {
            return redirect()->back()
                ->with([
                    'status' => 'Method Not Found!'
                ]);
        }

        $this->validator($request);

        $method->method_name = $request->post('method_name');
        $method->method_charge = $request->post('method_charge');
        $method->method_time = $request->post('method_time');
        $method->method_note = $request->post('method_note');
        $method->method_available_outside = $request->post('method_available_outside');
        $method->method_active = $request->post('method_active');

        if(!$method->save()) {
            return redirect()
                ->back()->withInput()
                ->with([
                    'status' => 'Something went wrong! Please try again later.'
                ]);
        }
        return redirect()
            ->route('admin.shipping')
            ->with([
                'status' => 'Method updated successfully.!'
            ]);
    }

    public function delete(Request $request) {
        $method = DeliveryMethod::find($request->post('id'));
        if(!$method) {
            return redirect()->back()
                ->with([
                    'status' => 'Method not found!'
                ]);
        }

        if(!$method->delete()) {
            return redirect()
                ->back()
                ->with([
                    'status' => 'Something went wrong! Please try again later.'
                ]);
        }
        return redirect()
            ->back()
            ->with([
                'status' => 'Method deleted successfully.!'
            ]);
    }

    /**
     * @param Request $request
     * @throws ValidationException
     */
    protected function validator(Request $request) {
        $this->validate($request, [
            'method_name'               => 'required|string|max:255',
            'method_charge'             => 'required|numeric',
            'method_time'               => 'nullable|string|max:191',
            'method_note'               => 'nullable|string|max:191',
            'method_available_outside'  => 'required|numeric|min:0|max:1',
            'method_active'             => 'required|numeric|min:0|max:1'
        ]);
    }
}
