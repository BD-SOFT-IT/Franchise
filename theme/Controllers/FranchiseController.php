<?php

namespace Theme\Controllers;

use App\Http\Controllers\Controller;

class FranchiseController extends Controller
{
    public function __construct() {
        $this->middleware(['guest']);
    }

    public function register() {
        return view('theme::franchise');
    }
}
