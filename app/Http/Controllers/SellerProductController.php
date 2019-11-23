<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\RbtMobileSms\Exception\Exception;
use App\SellerProduct;
use Illuminate\Http\Request;

class SellerProductController extends Controller
{
    public function processNewProduct(Request $request)
    {
//        $images = $request->file('product_image_path');
//        foreach ($images as $image) {
//            $reImagesName = date('YmdHis') . '.' . time() . '.' . $images->getClientOriginalName();
//            $dir = './sellers/products';
//            $images->move($dir, $reImagesName);
//            $imagesUrl = $dir . $reImagesName;
//
//            $newSubImageModel = new newSubImageModel();
//            $newSubImageModel->product_id = Se
//        }






        //Validating Seller Product information

//        $this->validate($request, [
//            'product_title' => 'required | max:20 | string',
//            'product_vendor_name' => 'required | max:20',
//            'product_unit' => 'required | numeric',
//            'product_unit_cost' => 'required | numeric',
//            'product_unit_mrp' => 'required | numeric',
//            'product_description' => 'required | max:1200',
//            'product_category' => 'required | string',
//            'product_sub_category' => 'required | string',
//            'product_unit_stock' => 'required | numeric',
//            'product_unit_availability' => 'required',
//            'product_image_path'    => 'required | image|mimes:jpeg,png,jpg,gif,svg|max:2048'
//        ]);

//        if ($request->hasFile('product_image_path')){
//            $productImages = $request->file('product_image_path');
//            $renameProductImage = time() . date('YmdHis'). '.' . $productImages->getClientOriginalExtension();
//            $destinationPath = public_path('/sellers/products');
//            $productImages->move($destinationPath, $renameProductImage);
//
//            $sellerProduct = new SellerProduct();
//            $sellerProduct->product_image_path = $renameProductImage;
//            $sellerProduct->save();
//
//            dd($sellerProduct);
//        }




        //All Validated data stored for transmit in database
//        $validateProductData = [
//            'product_title' => $request->input('product_title'),
//            'product_vendor_name' => $request->input('product_vendor_name'),
//            'product_unit' => $request->input('product_unit'),
//            'product_unit_cost' => $request->input('product_unit_cost'),
//            'product_unit_mrp' => $request->input('product_unit_mrp'),
//            'product_description' => $request->input('product_description'),
//            'product_category' => $request->input('product_category'),
//            'product_sub_category' => $request->input('product_sub_category'),
//            'product_unit_stock' => $request->input('product_unit_stock'),
//            'product_unit_availability' => $request->input('product_unit_availability'),
//            'product_image_path' => $request->input('product_image_path'),
//        ];


        // Storing validate Product information into database
//        try {
//            SellerProduct::create($validateProductData);
//
//            $this->setSuccessMessage('Congratulations! Your product in the Queue');
//            return redirect()->route('seller.allApprovedProducts');
//
//        } catch (Exception $productInformationException) {
//            $this->setErrorMessage('Opps! Something missed.');
//
//        }

        return $request->all();
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
