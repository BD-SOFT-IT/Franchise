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
//        $this->middleware('seller')->except('logout');
//    }

    // Seller Registration Function
    public function approval(Request $request)
    {
        // Validate Seller Registration Information

        $this -> Validate($request,[
            'seller_name'           => 'required | min:5 |',
            'seller_email'          => 'required | email |unique:sellers,seller_email',
            'seller_password'       => 'required | min:8',
            'seller_shop_name'      => 'required | min:2',
            'seller_shop_address'   => 'required | min:4',
            'seller_shop_city'      => 'required',
            'seller_shop_district'  => 'required',
            'seller_shop_division'  => 'required',
            'seller_shop_postcode'  => 'required | numeric',
            'seller_shop_identity'  => 'required | numeric',
            'seller_phone_number'  => 'required | numeric'
        ]);


        // Store Seller Information after Validate

        $validateSellerInformation = [
            'seller_account_type'   => $request->input('seller_account_type'),
            'seller_name'           => $request->input('seller_name'),
            'seller_email'          => strtolower($request->input('seller_email')),
//            'seller_password'       => bcrypt($request->input('seller_password')),
            'seller_password'       => Hash::make($request->input('seller_password')),
            'seller_shop_name'      => $request->input('seller_shop_name'),
            'seller_shop_address'   => $request->input('seller_shop_address'),
            'seller_shop_city'      => $request->input('seller_shop_city'),
            'seller_shop_district'  => $request->input('seller_shop_district'),
            'seller_shop_division'  => $request->input('seller_shop_division'),
            'seller_shop_postcode'  => $request->input('seller_shop_postcode'),
            'seller_shop_identity'  => $request->input('seller_shop_identity'),
            'seller_phone_number'  => $request->input('seller_phone_number')
        ];

        // Storing validate information in database
        try{

            Seller::create($validateSellerInformation);

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
        return view('seller.seller_dashboard.seller-profile');

    }


    //Seller Sign out Function
    public function signout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('seller/pages/auth/seller-login');
    }
}
