<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Coupon;
use App\Models\CouponHistory;
use App\Models\DeliveryMethod;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ReferralPoint;
use App\Notifications\OrderReceived;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use stdClass;

class CheckoutController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except('shippingMethods');
    }

    public function shippingMethods() {
        $methods = DeliveryMethod::whereMethodActive(true)
            ->orderBy('method_name')
            ->select([
                    'delivery_methods.method_id AS id', 'delivery_methods.method_name AS name', 'delivery_methods.method_charge AS charge',
                    'delivery_methods.method_available_outside AS outside', 'delivery_methods.method_time AS time', 'delivery_methods.method_note AS note'
            ])
            ->get();
        return response()->json($methods, 200);
    }

    public function placeOrder(Request $request) {
        $franchise = $this->checkForVendor($request->json('products'));
        if($franchise === false) {
            return sendNotFoundJsonResponse('Franchise not found or multiple franchise input.');
        }
        $products = $this->validateAndCreateProductsArray($request->json('products'), $franchise);

        $billing_address = $request->json('billing_address');
        $shipping_address = $request->json('shipping_address');
        $payment = $request->json('payment');
        $delivery_method = $this->validateShippingMethod($request->input('delivery'));
        $coupon = validateCoupon(['coupon' => $request->input('coupon'), 'total' => $products->sum('od_product_total')]);

        $client = $this->updateClient($billing_address);

        if(!$shipping_address) {
            $shipping_address = $billing_address;
        }

        $order = new Order();

        $order->order_no = createOrderNo();
        $order->order_for_franchise = $franchise ? $franchise->franchise_id : null;
        $order->order_client_id = $client->client_id;
        $order->order_shipping_method = $delivery_method->method_id;
        $order->order_shipping_person = $shipping_address['first_name'] . ' ' . $shipping_address['last_name'];
        $order->order_shipping_phone = mobileNumberForStore($shipping_address['mobile']);
        $order->order_shipping_address = $shipping_address['address'];
        $order->order_shipping_area = $shipping_address['area'];
        $order->order_shipping_city = $shipping_address['city'];
        $order->order_shipping_state = $shipping_address['state'];
        $order->order_shipping_postcode = $shipping_address['postcode'];
        $order->order_products_total = $products->sum('od_product_total');

        $discount = 0;
        if($coupon) {
            if($coupon->coupon_discount_amount) {
                $discount = $coupon->coupon_discount_amount;
            } else {
                $discount = $products->sum('od_product_total') * ($coupon->coupon_discount_percentage / 100);
                if($discount > $coupon->coupon_max_amount) {
                    $discount = $coupon->coupon_max_amount;
                }
            }
            $order->order_coupon_code_discount = $discount;
        }
        $order->order_total = ($products->sum('od_product_total') - $discount) + $delivery_method->method_charge;
        $order->order_total_due = ($products->sum('od_product_total') - $discount) + $delivery_method->method_charge;
        $order->order_payment_type = $payment['method'];

        $log = makeNewLog([
            'type'          => 'Order Created',
            'author_type'   => 'Client',
            'author_id'     => auth()->id(),
            'author_name'   => auth()->user()->first_name,
            'time'          => Carbon::now()
        ], null, true);
        $order->order_log = $log;

        if($payment['method'] !== 'cash') {
            $order->order_note = $request->input('note') . "\nPayment: " . $payment['method'] . "\nPayment Amount: " . $payment['amount'] . "\nTransaction: " . $payment['transaction'];
        } else {
            $order->order_note = $request->input('note');
        }

        if(!$order->save()) {
            return sendServerErrorJsonResponse();
        }
        $this->createOrderDetails($products, $order);
        if($discount > 0) {
            $this->createCouponHistory($coupon, $order->order_id);
        }

        $cartCookie = Cookie::make('_bsoft_crt', null, -60, '/');
        $cartCoupon = Cookie::make('_bsoft_cpn', null, -60, '/');

        auth()->user()->notify(new OrderReceived($order->order_no, $order->order_total));

        return response()->json($order, 200)
            ->withCookie($cartCookie)
            ->withCookie($cartCoupon);
    }

    protected function validateAndCreateProductsArray(array $data, $franchise = null) {
        $products = collect();
        if($franchise && $franchise->franchiseProducts) {
            foreach ($data as $item) {
                $product = $franchise->franchiseProducts()->find($item['id']);
                if(!$product) {
                    return sendNotFoundJsonResponse('Product(s) not found!');
                }
                $products->push($this->createSingleProductData($product, $item));
            }
        }
        else {
            foreach ($data as $item) {
                $product = Product::find($item['id']);
                if(!$product) {
                    return sendNotFoundJsonResponse('Product(s) not found!');
                }
                $products->push($this->createSingleProductData($product, $item));
            }
        }
        return $products;
    }

    protected function validateShippingMethod(int $id) {
        $delivery = DeliveryMethod::find($id);

        return $delivery;
    }

    protected function updateClient(array $billing) {
        $client = Client::find(auth()->id());

        if(!$client->mobile) {
            $client->mobile = mobileNumberForStore($billing['mobile']);
        }
        if($client->mobile && $client->mobile != mobileNumberForStore($billing['mobile'])) {
            $client->mobile_secondary = mobileNumberForStore($billing['mobile']);
        }
        if(!$client->email && $billing['email']) {
            $client->email = $billing['email'];
        }
        if(!$client->first_name) {
            $client->first_name = $billing['first_name'];
        }
        if(!$client->last_name) {
            $client->last_name = $billing['last_name'];
        }
        if(!$client->billing_address) {
            $client->billing_address = $billing['address'];
        }
        if(!$client->billing_area) {
            $client->billing_area = $billing['area'];
        }
        if(!$client->billing_city) {
            $client->billing_city = $billing['city'];
        }
        if(!$client->billing_state) {
            $client->billing_state = $billing['state'];
        }
        if(!$client->billing_postcode) {
            $client->billing_postcode = $billing['postcode'];
        }
        $client->save();
        return $client;
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
        $od->od_product_unit_mrp = ($product->product_discounted) ? $product->product_discounted_price : $product->product_unit_mrp;
        $od->od_product_quantity = $item['qty'];
        $od->od_product_discount_amount = $product->product_discount_amount * $item['qty'];
        $od->od_product_discount_percentage = $product->product_discount_percentage;
        $od->od_product_total = ($product->product_discounted) ? ($product->product_discounted_price * $item['qty']) : ($product->product_unit_mrp * $item['qty']);

        return $od;
    }

    /**
     * @param array $cart
     * @return Admin|Builder|Model|object|null|bool
     */
    protected function checkForVendor(array $cart) {
        $vendor = null;
        foreach ($cart as $item) {
            if($item['fran'] !== null) {
                $franchise = Admin::whereFranchiseId($item['fran'])->first();
                if(!$franchise) {
                    return false;
                }
                else if($vendor && $vendor->franchise_id !== $franchise->franchise_id) {
                    return false;
                }
                $vendor = $franchise;
            }
        }
        return $vendor;
    }

    protected function createCouponHistory(Coupon $coupon, int $order) {
        $ch = new CouponHistory();

        $ch->ch_client_id = auth()->id();
        $ch->ch_coupon_code = $coupon->coupon_code;
        $ch->ch_used_order_id = $order;

        $ch->save();

        if($coupon->coupon_type === 'referral') {
            $referrer = $coupon->referrer;

            $point = ReferralPoint::wherePointClient($referrer->client_id)->first();

            if(!$point) {
                $point = new ReferralPoint();

                $point->point_client = $referrer->client_id;
                $point->point_value = 50.00;
            }
            else {
                $point->point_value += 50.00;
            }
            $point->save();
        }
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
