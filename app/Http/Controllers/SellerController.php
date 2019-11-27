<?php

namespace App\Http\Controllers;

use App\RbtMobileSms\Exception\Exception;
use App\Seller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;

class SellerController extends Controller
{
    use AuthenticatesUsers;

//    public function __construct()
//    {
////        $this->middleware('guest')->except('logout');
////        $this->middleware('guest:seller')->except('logout');
//    }

//    public function __construct() {
//        $this->middleware(['auth:seller']);
//    }

//    protected $redirectTo = '/seller/login';


//    public function __construct()
//    {
//        $this->middleware(['guest:admin'])->except('logout');
//        $this->middleware('admin')->only('logout');
//    }


    // Seller Registration Function
    public function processRegistration(Request $request)
    {
        // Validate Seller Registration Information

        $this -> Validate($request,[
            'type_of_seller'            => 'required',
            'shop_name'                 => 'required | min:4',
            'shop_address'              => 'required | max:20',
            'shop_road_number'          => 'required',
            'shop_district'             => 'required',
            'shop_url'                  => 'required',
            'shop_identity'             => 'required | numeric',
            'seller_first_name'         => 'required',
            'seller_last_name'          => 'required',
            'seller_email'              => 'required | email | unique:sellers,seller_email',
            'seller_password'           => 'required | min:6',
            'seller_number'             => 'required',
            'seller_alt_number'         => 'required',
            'seller_terms_conditions'   => 'required'
        ]);

        // Store Seller Information after Validate

        $validateSellerInfo = [
            'type_of_seller'            => $request->input('type_of_seller'),
            'shop_name'                 => $request->input('shop_name'),
            'shop_address'              => $request->input('shop_address'),
            'shop_road_number'          => $request->input('shop_road_number'),
            'shop_district'             => $request->input('shop_district'),
            'shop_url'                  => $request->input('shop_url'),
            'shop_identity'             => $request->input('shop_identity'),
            'seller_first_name'         => $request->input('seller_first_name'),
            'seller_last_name'          => $request->input('seller_last_name'),
            'seller_email'              => strtolower($request->input('seller_email')),
            'seller_password'           => Hash::make($request->input('seller_password')),
            'seller_number'             => $request->input('seller_number'),
            'seller_alt_number'         => $request->input('seller_alt_number'),
            'seller_terms_conditions'   => $request->input('seller_terms_conditions')
        ];

        // Sending validate data to store in Database
        try{

            $registeredSeller = Seller::create($validateSellerInfo);

            $this -> setSuccessMessage('User');

            return redirect()->back();

//            return redirect()->action('SellerController@showLoginForm');
        }
        catch (Exception $sellerRegistrationDataException){

            $this -> setErrorMessage('Opps!');

            return redirect()->back();
        }
    }


    // Seller Show login form
    public function showLoginForm()
    {
        return view('seller.pages.auth.seller-login');
    }

    // Seller Login Process Functionality
    public function processLogin(Request $request)
    {
        $seller = \DB::table('sellers')->where('seller_email','=',$request->input('seller_email'))->first();

        if (!$seller)
        {
            return redirect()->back()->with('errorEmail' , 'Opps! We could not find you E-mail in our record Seller');
        }
        if (!Hash::check($request->input('seller_password'),$seller->seller_password))
        {
            return redirect()->back()->with('errorPassword' , 'Opps! Login Failed. Credentials does not match');
        }

//        $credentials = $request->only('seller_email','seller_password');
//        if (Auth::attempt($credentials)){
//            return redirect()->intended(route('seller.seller-profile'));
//        }


//        if (Auth::attempt($credentials) {
//            // if successful, then redirect to their intended location
            return redirect()->intended(route('seller.dashboard'));
//        }
//        return redirect()->back();
    }




    //Seller Sign out Function
    public function signout(Request $request)
    {
//        $this->guard('seller')->logout();
//
//        $request->session()->invalidate();
        Auth::guard('seller')->logout();


        return redirect('seller/login')->with('seller', 'Get out');
    }

}
