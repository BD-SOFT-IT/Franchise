<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\RbtMobileSms\Exception\Exception;
use App\SellerProduct;
use App\SellerProductImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'product_images' => 'required | max:5'
        ]);

        try{
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
                $dir = './sellerProductImages/products/';
                $image->move($dir, $reImagesName);
                $imagesPath = $dir . $reImagesName;

                $sellerProductImage = new SellerProductImages();
                $sellerProductImage->product_id = $sellerProduct->product_id;
                $sellerProductImage->images_path = $imagesPath;
                $sellerProductImage->save();
            }
//            $this->setAddProductSuccess($message);

            return redirect()->route('seller.allApprovedProducts');

        }catch (Exception $productAddException)
        {
//            $this->setAddProductError($message);

            return redirect()->back();
        }

    }



    public function allApprovedProducts()
    {
        $sellerProducts = SellerProduct::all();


        return view('seller.seller_dashboard.approved-products')->with([
            'sellerProducts'    => $sellerProducts
        ]);
    }

    public function editProduct($edit_product_id)
    {
        $product = SellerProduct::find($edit_product_id);

        return view('seller.seller_dashboard.edit-product')->with([
            'product' => $product
        ]);
    }


    public function updateProduct(Request $request, $edit_product_id)
    {
        $updateProduct = SellerProduct::find($edit_product_id);

//        $this->validate($request, [
//            'product_name' => 'required | max:20 | string',
//            'product_brand' => 'required',
//            'product_category' => 'required | numeric',
//            'product_unit_cost' => 'required | numeric',
//            'product_unit_mrp' => 'required | numeric',
//            'product_unit_stock' => 'required | numeric',
//            'product_description' => 'required | max:1200',
//            'product_availability' => 'required',
//            'product_images' => 'required | max:5'
//        ]);

        $updateProduct->product_name                = $request->product_name;
        $updateProduct->product_brand               = $request->product_brand;
        $updateProduct->product_category            = $request->product_category;
        $updateProduct->product_unit_cost           = $request->product_unit_cost;
        $updateProduct->product_unit_mrp            = $request->product_unit_mrp;
        $updateProduct->product_unit_stock          = $request->product_unit_stock;
        $updateProduct->product_description         = $request->product_description;
        $updateProduct->product_availability        = $request->product_availability;
        $updateProduct->product_feature             = $request->product_feature;
        $updateProduct->product_color               = $request->product_color;
        $updateProduct->product_size                = $request->product_size;
        $updateProduct->product_discount            = $request->product_discount;

        $updateProduct->save();

        $images = $request->file('product_images');
        foreach ($images as $image) {
            $reImagesName = date('YmdHis') . '.' . time() . '.' . $image->getClientOriginalName();
            $dir = './sellerProductImages/products/';
            $image->move($dir, $reImagesName);
            $imagesPath = $dir . $reImagesName;

            $sellerProductImage = new SellerProductImages();
            $sellerProductImage->product_id = $updateProduct->product_id;
            $sellerProductImage->images_path = $imagesPath;
            $sellerProductImage->save();
        }


        return redirect('seller/seller_dashboard/approved-products')->with([
            'updateProduct'    => $updateProduct
        ]);
    }

    public function previewProduct($preview_product_id)
    {
        $sellerProduct = SellerProduct::find($preview_product_id);

        $sellerProductImage = SellerProductImages::where('product_id', $sellerProduct->product_id)->get();

//        $sellerProducts = SellerProduct::all();

//        $sellerProductJoin =  DB::table('seller_products')
//            ->join('categories', 'seller_products.product_category', '=','categories.category_id')
//            ->select('seller_products.*', 'categories.*',
//                    'categories.category_title')
//            ->get();



        return view('seller/seller_dashboard/preview-product')->with([
//            'sellerProduct'    => $sellerProduct,
            'sellerProductImages'   => $sellerProductImage,
            'sellerProducts'    => $sellerProduct

//            'sellerProductJoin' => $sellerProductJoin
        ]);
    }

    public function deleteProduct($product_id)
    {
        $sellerProduct = SellerProduct::find($product_id);

        //$sellerProduct->delete();
        \DB::table('seller_products')->whereIn('product_id',$sellerProduct)->delete();

        // Delete all images
//        foreach ($sellerProduct->images as $img) {
//            // Delete from path
//            $file_name = $img->images;
//            if (file_exists("sellerProductImages/products/".$file_name)) {
//                unlink("sellerProductImages/products/".$file_name);
//            }
//
//            $img->delete();
//        }

        return redirect()->back()->with('productDeleteMessage','Opps! You deleted a valuable product');
    }
}
