<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\RbtMobileSms\Exception\Exception;
use App\SellerProduct;
use App\SellerProductImages;
use Illuminate\Http\Request;

class SellerProductController extends Controller
{
    public function processNewProduct(Request $request)
    {
//        Validating Seller Product information

        $this->validate($request, [
            'product_name' => 'required | max:20 | string',
            'product_brand' => 'required',
            'product_category' => 'required | numeric',
            'product_unit_cost' => 'required | numeric',
            'product_unit_mrp' => 'required | numeric',
            'product_unit_stock' => 'required | numeric',
            'product_description' => 'required | max:1200',
            'product_availability' => 'required',
            'product_images' => 'required'
        ]);

        $sellerProduct = new SellerProduct();

        $sellerProduct->product_name = $request->product_name;
        $sellerProduct->product_brand = $request->product_brand;
        $sellerProduct->product_category = $request->product_category;
        $sellerProduct->product_code = $request->product_code;
        $sellerProduct->product_unit_cost = $request->product_unit_cost;
        $sellerProduct->product_unit_mrp = $request->product_unit_mrp;
        $sellerProduct->product_unit_stock = $request->product_unit_stock;
        $sellerProduct->product_description = $request->product_description;
        $sellerProduct->product_availability = $request->product_availability;
        $sellerProduct->product_feature = $request->product_feature;
        $sellerProduct->product_color = $request->product_color;
        $sellerProduct->product_size = $request->product_size;
        $sellerProduct->product_discount = $request->product_discount;
        $sellerProduct->save();

        $images = $request->file('product_images');
        foreach ($images as $image) {
            $reImagesName = date('YmdHis') . '.' . time() . '.' . $image->getClientOriginalName();
            $dir = './sellerProductImages/products';
            $image->move($dir, $reImagesName);
            $imagesPath = $dir . $reImagesName;

            $sellerProductImage = new SellerProductImages();
            $sellerProductImage->product_id = $sellerProduct->product_id;
            $sellerProductImage->images_path = $imagesPath;
            $sellerProductImage->save();
        }
        return redirect()->back()->with('success', 'Added Successful!');

    }



    public function allApprovedProducts()
    {
        $sellerProducts = SellerProduct::all();

        return view('seller.seller_dashboard.approved-products', compact('sellerProducts'));
    }

    public function editProduct($edit_product_id)
    {
        $product = SellerProduct::find($edit_product_id);

        return view('seller.seller_dashboard.edit-product', compact('product'));
    }


    public function updateProduct(Request $request)
    {
        $updateProduct = SellerProduct::find($request->product_id);


        $updateProduct->product_title               = $request->product_title;
        $updateProduct->product_vendor_name         = $request->product_vendor_name;
        $updateProduct->product_unit                = $request->product_unit;
        $updateProduct->product_unit_cost           = $request->product_unit_cost;
        $updateProduct->product_unit_mrp            = $request->product_unit_mrp;
        $updateProduct->product_description         = $request->product_description;
        $updateProduct->product_category            = $request->product_category;
//        $updateProduct->product_sub_category        = $request->product_sub_category;
        $updateProduct->product_unit_stock          = $request->product_unit_stock;
        $updateProduct->product_unit_availability   = $request->product_unit_availability;
        $updateProduct->product_image_path          = $request->product_image_path;

        $updateProduct->save();


        return redirect('seller/seller_dashboard/approved-products');
    }

    public function previewProduct()
    {
        return view('seller/seller_dashboard/preview-product');
    }

    public function deleteProduct($product_id)
    {
        $sellerProduct = SellerProduct::find($product_id);

        //$sellerProduct->delete();
        \DB::table('seller_products')->whereIn('product_id',$sellerProduct)->delete();

        return redirect()->back()->with('productDeleteMessage','Opps! You deleted a valuable product');
    }
}
