<?php

namespace App\Http\Controllers\Admin\Axios\Franchise;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Notifications\OrderReceived;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use stdClass;

class CheckoutController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function placeOrder(Request $request) {
        $products = $this->validateAndCreateProductsArray($request->json('products'));

        $shipping_address = $request->json('shipping_address');
        $payment = $request->json('payment');

        $order = new Order();

        $order->order_no = createOrderNo();
        $order->order_by_franchise = auth('admin')->user()->franchise_id;
        $order->order_shipping_person = $shipping_address['first_name'] . ' ' . $shipping_address['last_name'];
        $order->order_shipping_phone = mobileNumberForStore($shipping_address['mobile']);
        $order->order_shipping_address = $shipping_address['address'];
        $order->order_shipping_area = $shipping_address['area'];
        $order->order_shipping_city = $shipping_address['city'];
        $order->order_shipping_state = $shipping_address['state'];
        $order->order_shipping_postcode = $shipping_address['postcode'];
        $order->order_products_total = $products->sum('od_product_total');

        $order->order_total = $products->sum('od_product_total');
        $order->order_total_due = $products->sum('od_product_total');
        $order->order_payment_type = $payment['method'];
        $order->order_payment_status = 'Due';

        $log = makeNewLog([
            'type'          => 'Order Created',
            'author_type'   => 'Franchise',
            'author_id'     => auth('admin')->id(),
            'author_name'   => auth('admin')->user()->first_name,
            'time'          => Carbon::now()
        ], null, true);
        $order->order_log = $log;

        if(in_array($payment['method'], ['bKash', 'rocket', 'nogod'])) {
            $order->order_note = $request->input('note') . "\n->Payment: " . $payment['method'] . "\n->Payment Amount: " . $payment['amount'] . "\n->Transaction: " . $payment['transaction'];
        } else {
            $order->order_note = $request->input('note');
        }

        if(!$order->save()) {
            return sendServerErrorJsonResponse();
        }
        $this->createOrderDetails($products, $order);

        $cartCookie = Cookie::make('_bsoft_franchise_crt', null, -60, '/');

        auth('admin')->user()->notify(new OrderReceived($order->order_no, $order->order_total));

        return response()->json($order, 200)
            ->withCookie($cartCookie);
    }

    protected function validateAndCreateProductsArray(array $data) {
        $products = collect();

        foreach ($data as $item) {
            $product = Product::find($item['id']);
            if(!$product) {
                return sendNotFoundJsonResponse('Product(s) not found!');
            }
            $products->push($this->createSingleProductData($product, $item));
        }
        return $products;
    }

    /**
     * @param Product $product
     * @param $item
     * @return stdClass
     */
    protected function createSingleProductData(Product $product, $item) {
        $od = new stdClass();
        $od->od_product_id = $product->product_id;
        $od->od_product_size = $item['size'];
        $od->od_product_color = $item['color'];
        $od->od_product_unit_cost = $product->product_unit_cost;
        $od->od_product_unit_mrp = $product->product_unit_mrp_franchise ? $product->product_unit_mrp_franchise : 0;
        $od->od_product_quantity = $item['qty'];
        $od->od_product_discount_amount = 0;
        $od->od_product_discount_percentage = 0;
        $od->od_product_total = $product->product_unit_mrp_franchise * $item['qty'];

        return $od;
    }

    protected function createOrderDetails(Collection $products, Order $order) {
        foreach ($products as $product) {
            $od = new OrderDetail();

            $od->od_order_id = $order->order_id;
            $od->od_product_id = $product->od_product_id;
            $od->od_product_size = $product->od_product_size;
            $od->od_product_color = $product->od_product_color;
            $od->od_product_unit_cost = $product->od_product_unit_cost;
            $od->od_product_unit_mrp = $product->od_product_unit_mrp;
            $od->od_product_quantity = $product->od_product_quantity;
            $od->od_product_discount_amount = $product->od_product_discount_amount;
            $od->od_product_discount_percentage = $product->od_product_discount_percentage;
            $od->od_product_total = $product->od_product_total;

            $od->save();
        }
    }
}
