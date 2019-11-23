<?php

namespace Theme\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request) {
        $cart = $request->cookie('_bsoft_crt');
        if(!$cart || count(json_decode($cart)) <= 0) {
            return redirect()->route('shop');
        }

        return view('theme::checkout');
    }

}
