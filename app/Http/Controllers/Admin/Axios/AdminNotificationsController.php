<?php

namespace App\Http\Controllers\Admin\Axios;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;

class AdminNotificationsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware(['checkSA', 'admin', 'auth:admin']);
    }

    public function pendingOrders() {
        if(auth('admin')->user()->isShipper()) {
            $orders = Order::where('order_shipper_id', '=', auth('admin')->user()->shipper->shipper_id)
                ->where('order_progress', '=', 'on delivery')
                ->whereNull('order_for_franchise')
                ->orderBy('order_no', 'ASC')
                ->join('clients', 'orders.order_client_id', '=', 'clients.client_id')
                ->select(['orders.order_no', 'orders.order_total', 'orders.created_at', 'clients.first_name', 'clients.last_name'])
                ->get();
        }
        else if(auth('admin')->user()->isFranchise()) {
            $orders = Order::where('order_for_franchise', '=', auth('admin')->user()->franchise_id)
                ->where('order_progress', '=', 'pending')
                ->orderBy('order_no', 'ASC')
                ->join('clients', 'orders.order_client_id', '=', 'clients.client_id')
                ->select(['orders.order_no', 'orders.order_total', 'orders.created_at', 'clients.first_name', 'clients.last_name'])
                ->get();
        }
        else {
            $orders = Order::where('order_progress', '=', 'pending')
                ->orderBy('order_no', 'ASC')
                ->whereNull('order_for_franchise')
                ->join('clients', 'orders.order_client_id', '=', 'clients.client_id')
                ->select(['orders.order_no', 'orders.order_total', 'orders.created_at', 'clients.first_name', 'clients.last_name'])
                ->get();
        }
        $output = [];
        if($orders) {
            foreach($orders as $order) {
                $new_order = new \stdClass();
                $new_order->client_name = $order->first_name . ' ' . $order->last_name;
                $new_order->order_no = $order->order_no;
                $new_order->order_total = $order->order_total;
                $new_order->created_before = Carbon::parse($order->created_at)->diffForHumans(Carbon::now());
                array_push($output, $new_order);
            }
        }
        return response()->json($output, 200);
    }

    public function orderInProgress() {
        if(auth('admin')->user()->isFranchise()) {
            $orders = Order::whereNotIn('order_progress', ['delivered', 'canceled'])
                ->where('order_for_franchise', '=', auth('admin')->user()->franchise_id)
                ->orderByDesc('order_no')
                ->select(['orders.order_no', 'orders.order_progress', 'orders.order_shipper_id'])
                ->get();
        } else {
            $orders = Order::whereNotIn('order_progress', ['delivered', 'canceled'])
                ->whereNull('order_for_franchise')
                ->orderByDesc('order_no')
                ->select(['orders.order_no', 'orders.order_progress', 'orders.order_shipper_id'])
                ->get();
        }

        $filtered_orders = [];

        foreach($orders as $order) {
            if(auth('admin')->user()->can('view-order', $order)) {
                array_push($filtered_orders, $order);
            }
        }

        return response()->json($filtered_orders, 200);
    }
}
