<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\WishList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return response()->json($this->wishlistProducts(), 200);
    }

    public function store(Request $request) {
        $product = Product::find($request->post('pid'));
        if(!$product) {
            sendNotFoundJsonResponse('Product Not Found');
        }

        $wishlist = WishList::whereWlClientId(Auth::id())
            ->where('wl_product_id', '=', $product->product_id)
            ->first();

        if($wishlist) {
            return response()->json('Already Exists!', 409);
        }

        $wishlist = WishList::create([
            'wl_client_id'  => Auth::id(),
            'wl_product_id' => $product->product_id
        ]);

        return response()->json($wishlist, 200);
    }

    public function remove($id) {
        $wishlist = WishList::whereWlClientId(Auth::id())
            ->where('wl_product_id', '=', $id)
            ->first();
        if(!$wishlist) {
            return sendNotFoundJsonResponse('Not Found');
        }

        if(!$wishlist->delete()){
            return sendServerErrorJsonResponse();
        }

        return response()->json([
            'status'    => 'Successfully Removed!',
            'wishlist'  => $this->wishlistProducts()
        ], 200);
    }

    /**
     * @return array|null
     */
    protected function wishlistProducts() {
        $wishlist = WishList::whereWlClientId(Auth::id())->get();

        $products = [];
        foreach ($wishlist as $item) {
            $p = $item->product;
            $product = new \stdClass();
            $product->id = $p->product_id;
            $product->title = $p->product_title;
            $product->slug = route('product.single', ['slug' => $p->product_slug]);

            $discounted_price = ($p->product_discounted)
                ? getDiscountedAmount($p->product_unit_mrp, $p->product_discount_amount, $p->product_discount_percentage)
                : $p->product_unit_mrp;

            $product->current_price = $discounted_price;
            $product->old_price = ($p->product_discounted) ? $p->product_unit_mrp : null;
            $product->status = $p->product_availability_status;
            $product->image = ($p->product_img_main && strlen($p->product_img_main)) ? imageCache($p->product_img_main, '80') : 'https://via.placeholder.com/80x80';

            array_push($products, $product);
        }

        return $products;
    }
}
