<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Seller;
use App\SellerBrand;
use App\Models\SellerProduct;
use App\Models\SellerProductImage;
use DB;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Auth;

class SellerPagesController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:seller');
    }


    public function profile()
    {

        $sellerProduct = DB::table('seller_products')
            ->select(DB::raw('COUNT(product_id) AS product_id'))
            ->get();

        return view('seller.seller_dashboard.seller-profile')->with([
            'sellerProduct'   => $sellerProduct
        ]);
    }

    public function contact()
    {
        return view('seller.seller_dashboard.seller-contact');
    }

    public function addNewProduct(Request $request)
    {
        $categories = Category::all();

        $productBrands = ProductBrand::all();

        return view('seller.seller_dashboard.add-new-product',[
            'categories'    => $categories,
            'productBrands' => $productBrands
        ]);
    }
    public function CanceledProducts()
    {
        return view('seller.seller_dashboard.cancel-products');
    }
    public function getInvoice()
    {
        return view('seller.seller_dashboard.seller-invoice');
    }


}
