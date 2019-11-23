<?php

namespace App\Http\Controllers\Admin\Axios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Shipper;
use App\Models\Order;

class OrderAxiosController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware(['checkSA', 'admin', 'auth:admin']);
        $this->middleware('can:create-order')->only('store');
    }

    public function getOrders(Request $request, $type = 'all') {

        $type = strtolower(htmlspecialchars($type));
        $per_page = ($request->per_page)? $request->per_page : 15;
        $search = htmlspecialchars($request->search);


        if(auth('admin')->user()->isShipper()) {
            $shipper_id = auth('admin')->user()->shipper->shipper_id;

            if($type == 'all') {
                $orders = Order::where('order_shipper_id', '=', $shipper_id)
                    ->where('order_no', 'LIKE', "%$search%")
                    ->whereNull('order_for_franchise')
                    ->orderByDesc('order_no')
                    ->join('clients', 'orders.order_client_id', '=', 'clients.client_id')
                    ->select(['orders.*', 'clients.first_name', 'clients.last_name'])
                    ->paginate($per_page);
            }
            else if($type == 'pending') {
                $orders = Order::where('order_shipper_id', '=', $shipper_id)
                    ->where('order_progress', '=', 'on delivery')
                    ->where('order_no', 'LIKE', "%$search%")
                    ->whereNull('order_for_franchise')
                    ->orderBy('order_no', 'ASC')
                    ->join('clients', 'orders.order_client_id', '=', 'clients.client_id')
                    ->select(['orders.*', 'clients.first_name', 'clients.last_name'])
                    ->paginate($per_page);
            }
            else {
                $orders = Order::where('order_shipper_id', '=', $shipper_id)
                    ->where('order_progress', '=', $type)
                    ->where('order_no', 'LIKE', "%$search%")
                    ->whereNull('order_for_franchise')
                    ->orderByDesc('order_no')
                    ->join('clients', 'orders.order_client_id', '=', 'clients.client_id')
                    ->select(['orders.*', 'clients.first_name', 'clients.last_name'])
                    ->paginate($per_page);
            }
        }
        else if(auth('admin')->user()->isFranchise()) {
            if($type == 'all') {
                $orders = Order::where('order_for_franchise', '=', auth('admin')->user()->franchise_id)
                    ->where('order_no', 'LIKE', "%$search%")
                    ->orderByDesc('order_no')
                    ->join('clients', 'orders.order_client_id', '=', 'clients.client_id')
                    ->select(['orders.*', 'clients.first_name', 'clients.last_name'])
                    ->paginate($per_page);
            }
            else if($type == 'confirmed') {
                $orders = Order::where('order_for_franchise', '=', auth('admin')->user()->franchise_id)
                    ->whereIn('order_progress', ['processing', 'on delivery'])
                    ->where('order_no', 'LIKE', "%$search%")
                    ->orderByDesc('order_no')
                    ->join('clients', 'orders.order_client_id', '=', 'clients.client_id')
                    ->select(['orders.*', 'clients.first_name', 'clients.last_name'])
                    ->paginate($per_page);
            }
            else if($type == 'pending') {
                $orders = Order::where('order_for_franchise', '=', auth('admin')->user()->franchise_id)
                    ->where('order_progress', '=', $type)
                    ->where('order_no', 'LIKE', "%$search%")
                    ->orderBy('order_no', 'ASC')
                    ->join('clients', 'orders.order_client_id', '=', 'clients.client_id')
                    ->select(['orders.*', 'clients.first_name', 'clients.last_name'])
                    ->paginate($per_page);
            }
            else if($type == 'by-franchise') {
                $orders = Order::where('order_by_franchise', '=', auth('admin')->user()->franchise_id)
                    ->where('order_no', 'LIKE', "%$search%")
                    ->orderByDesc('order_no')
                    ->join('admins', 'orders.order_by_franchise', '=', 'admins.franchise_id')
                    ->select(['orders.*', 'admins.first_name', 'admins.last_name'])
                    ->paginate($per_page);
            }
            else {
                $orders = Order::where('order_for_franchise', '=', auth('admin')->user()->franchise_id)
                    ->where('order_progress', '=', $type)
                    ->where('order_no', 'LIKE', "%$search%")
                    ->orderByDesc('order_no')
                    ->join('clients', 'orders.order_client_id', '=', 'clients.client_id')
                    ->select(['orders.*', 'clients.first_name', 'clients.last_name'])
                    ->paginate($per_page);
            }
        }
        else {
            if($type == 'all') {
                $orders = Order::where('order_no', 'LIKE', "%$search%")
                    ->whereNull('order_for_franchise')
                    ->orderByDesc('order_no')
                    ->join('clients', 'orders.order_client_id', '=', 'clients.client_id')
                    ->select(['orders.*', 'clients.first_name', 'clients.last_name'])
                    ->paginate($per_page);
            }
            else if($type == 'confirmed') {
                $orders = Order::whereIn('order_progress', ['processing', 'on delivery'])
                    ->where('order_no', 'LIKE', "%$search%")
                    ->whereNull('order_for_franchise')
                    ->orderByDesc('order_no')
                    ->join('clients', 'orders.order_client_id', '=', 'clients.client_id')
                    ->select(['orders.*', 'clients.first_name', 'clients.last_name'])
                    ->paginate($per_page);
            }
            else if($type == 'pending') {
                $orders = Order::where('order_progress', '=', $type)
                    ->where('order_no', 'LIKE', "%$search%")
                    ->whereNull('order_for_franchise')
                    ->orderBy('order_no', 'ASC')
                    ->join('clients', 'orders.order_client_id', '=', 'clients.client_id')
                    ->select(['orders.*', 'clients.first_name', 'clients.last_name'])
                    ->paginate($per_page);
            }
            else if($type == 'for-franchise') {
                $orders = Order::whereNotNull('order_for_franchise')
                    ->where('order_no', 'LIKE', "%$search%")
                    ->orderByDesc('order_no')
                    ->join('clients', 'orders.order_client_id', '=', 'clients.client_id')
                    ->select(['orders.*', 'clients.first_name', 'clients.last_name'])
                    ->paginate($per_page);
            }
            else if($type == 'by-franchise') {
                $orders = Order::whereNotNull('order_by_franchise')
                    ->where('order_no', 'LIKE', "%$search%")
                    ->orWhere('order_progress', 'LIKE', "%$search%")
                    ->orderByDesc('order_no')
                    ->join('admins', 'orders.order_by_franchise', '=', 'admins.franchise_id')
                    ->select(['orders.*', 'admins.first_name', 'admins.last_name'])
                    ->paginate($per_page);
            }
            else {
                $orders = Order::where('order_progress', '=', $type)
                    ->where('order_no', 'LIKE', "%$search%")
                    ->whereNull('order_for_franchise')
                    ->orderByDesc('order_no')
                    ->join('clients', 'orders.order_client_id', '=', 'clients.client_id')
                    ->select(['orders.*', 'clients.first_name', 'clients.last_name'])
                    ->paginate($per_page);
            }
        }

        return response()->json($orders, 200);
    }

    public function store(Request $request) {

    }
}
