<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function search(Request $request) {
        $search = $request->post('search');

        $products = null;
        if(trim($search)) {
            $products = Product::where('product_active', '=', 1)
                ->where('product_title', 'LIKE', "%{$search}%")
                ->orderByDesc('updated_at')
                ->limit(20)
                ->get();

            $products = $products->map(function ($product, $key) {
                return [
                    'title' => $product->product_title,
                    'url'   => route('product.single', ['slug' => $product->product_slug]),
                    'image' => ($product->product_img_main && strlen($product->product_img_main) > 10)
                        ? imageCache($product->product_img_main, '400')
                        : (($default = getSiteBasic('default_product_image')) ? imageCache($default) : staticAsset('theme/images/logos/default_product.png'))
                ];
            });
        }
        return response()->json([
            'products'  => $products
        ], 200);
    }

    public function single($id) {
        $product = Product::whereProductActive(true)
            ->where('product_id', '=', $id)
            ->first();

        if(!$product) {
            return sendNotFoundJsonResponse('Product not found!');
        }

        return response()->json([
            'product'   => $product,
            'franchise' => getFranchises($product)
        ], 200);
    }
}
