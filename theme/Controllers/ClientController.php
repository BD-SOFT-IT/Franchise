<?php

namespace Theme\Controllers;

use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'verified']);
    }

    public function account() {
        return view('theme::account');
    }
}
