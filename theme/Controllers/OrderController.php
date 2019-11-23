<?php

namespace Theme\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'verified']);
    }

    public function show($no) {
        $order = auth()->user()->orders()
            ->where('order_no', '=', $no)
            ->first();

        if(!$order) {
            return view('theme::order-details')->with('status', 'Oops..! Order with NO #' . $no . ' not found!');
        }

        return view('theme::order-details')->with('order', $order);
    }
}
