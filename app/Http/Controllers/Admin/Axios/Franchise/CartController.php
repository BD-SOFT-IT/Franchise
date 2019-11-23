<?php

namespace App\Http\Controllers\Admin\Axios\Franchise;

use App\Models\Admin;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use stdClass;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'auth:admin']);
    }

    public function index() {
        $cart = Cookie::get('_bsoft_franchise_crt');
        if(!$cart) {
            return response()->json('You don\'t have any Product in Cart!', 200);
        }

        $cart = json_decode($cart);

        foreach ($cart as $index => $item) {
            $product = Product::find($item->id);
            if(!$product) {
                continue;
            }
            $cart[$index]->title = $product->product_title;
            $cart[$index]->slug = route('admin.products.single', ['sku' => $product->product_sku]);
            $cart[$index]->min = $product->product_units_min_franchise;
            $cart[$index]->image = ($product->product_img_main && strlen($product->product_img_main) > 10)
                ? imageCache($product->product_img_main, '80')
                : 'https://via.placeholder.com/100x100';
        }
        return response()
            ->json([
                'products'  => $cart
            ], 200);
    }

    public function add(Request $request) {
        if($request->has('uid') && $request->post('uid')) {
            $cartCookie = Cookie::get('_bsoft_franchise_crt');
            $cart = json_decode($cartCookie);
            $added = false;

            foreach ($cart as $index => $item) {
                if($item->uid == $request->post('uid')) {
                    $cart[$index]->qty += $request->post('qty');
                    $added = true;
                    break;
                }
            }
            if(!$added) {
                return sendServerErrorJsonResponse();
            }

            $cartCookie = Cookie::make('_bsoft_franchise_crt', json_encode($cart), 60 * 24 * 30, '/');

            return response()->json([
                'status'  => 'success'
            ], 200)->withCookie($cartCookie);
        }

        // for new item
        $product = Product::find($request->post('id'));
        if(!$product) {
            return response()
                ->json([
                    'status' => 'Product not found!'
                ], 404);
        }

        $cart = [];

        $cartCookie = Cookie::get('_bsoft_franchise_crt');
        if(!$cartCookie) {
            array_push($cart, $this->createCartProduct($product, $request->all()));
        }
        else {
            $cart = json_decode($cartCookie);
            array_push($cart, $this->createCartProduct($product, $request->all()));
        }

        $cartCookie = Cookie::make('_bsoft_franchise_crt', json_encode($cart), 60 * 24 * 30, '/');

        return response()->json([
            'status'  => 'success'
        ], 200)->withCookie($cartCookie);
    }

    public function delete(Request $request) {
        $cartCookie = Cookie::get('_bsoft_franchise_crt');

        if(!$cartCookie) {
            return response()->json('You don\'t have any Product in Cart!', 200);
        }

        $cart = json_decode($cartCookie);

        foreach ($cart as $index => $item) {
            $product = Product::find($item->id);
            if($item->uid == $request->post('uid')) {
                if($item->qty == $product->product_units_min_franchise || $request->post('destroy') == 1) {
                    unset($cart[$index]);
                    $cart = array_values($cart);
                }
                else {
                    $cart[$index]->qty -= 1;
                }
                break;
            }
        }

        $cartCookie = Cookie::make('_bsoft_franchise_crt', json_encode($cart), 60 * 24 * 30, '/');
        return response()->json([
            'status'  => 'success'
        ], 200)->withCookie($cartCookie);
    }

   /* public function destroy(Request $request) {

    }*/

    /**
     * @param Product $product
     * @param array $data
     * @return stdClass
     */
    protected function createCartProduct(Product $product, array $data) {
        $cart = new stdClass();

        $cart->uid = uniqid('bsit_');
        $cart->id = $product->product_id;
        $cart->qty = $data['qty'];
        $cart->price = $product->product_unit_mrp_franchise;
        $cart->size = isset($data['size']) ? $data['size'] : null;
        $cart->color = isset($data['color']) ? $data['color'] : null;

        return $cart;
    }
}
