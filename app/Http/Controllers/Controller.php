<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

//    public function setSuccessMessage($message): void
//    {
//        session()->flash('message', 'Congratulations! You are now a part of seller.');
//        session()->flash('type','success');
//    }
//    public function setErrorMessage($message): void
//    {
//        session()->flash('message', 'Opps! Did you missed some thing?');
//        session()->flash('type','danger');
//    }

//    public function setAddProductSuccess($message): void
//    {
//        session()->flash('message','Oh! Your product added successfully into table');
//        session()->flash('type', 'success');
//    }
//
//    public function setAddProductError($message): void
//    {
//        session()->flash('message','Opp! Something wrong here.');
//        session()->flash('type', 'danger');
//    }
}
