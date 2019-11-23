<?php

namespace Theme\Controllers;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index() {
        return view('theme::welcome');
    }

    public function wishlist() {
        return view('theme::wishlist');
    }
}
