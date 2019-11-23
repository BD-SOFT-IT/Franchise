<?php
// Helper Functions For Shop
use App\Models\Coupon;
use App\Models\Order;
use App\RbtMobileSms\Exception\InvalidMethodException;
use App\RbtMobileSms\MobileSms;
use Carbon\Carbon;

// get order summary
/**
 * @return stdClass
 */
function getOrderSummary() {

    $order_summary = new \stdClass();

    if (auth('admin')->user()->isShipper()) {
        $order_summary->pending = Order::where('order_progress', '=', 'on delivery')
            ->where('order_shipper_id', '=', auth('admin')->user()->shipper->shipper_id)
            ->whereNull('order_for_franchise')
            ->count();
        $order_summary->today = Order::whereDate('created_at', '=', Carbon::today())
            ->where('order_shipper_id', '=', auth('admin')->user()->shipper->shipper_id)
            ->whereNull('order_for_franchise')
            ->count();
        $order_summary->this_month = Order::whereMonth('created_at', Carbon::now()->month)
            ->where('order_shipper_id', '=', auth('admin')->user()->shipper->shipper_id)
            ->whereNull('order_for_franchise')
            ->count();
        $order_summary->last_month = Order::whereMonth('created_at', Carbon::now()->month-1)
            ->where('order_shipper_id', '=', auth('admin')->user()->shipper->shipper_id)
            ->whereNull('order_for_franchise')
            ->count();
        return $order_summary;
    }

    if (auth('admin')->user()->isFranchise()) {
        $order_summary->pending = Order::where('order_for_franchise', '=', auth('admin')->user()->franchise_id)
            ->where('order_progress', '=', 'pending')
            ->count();
        $order_summary->today = Order::where('order_for_franchise', '=', auth('admin')->user()->franchise_id)
            ->whereDate('created_at', '=', Carbon::today())
            ->count();
        $order_summary->this_month = Order::where('order_for_franchise', '=', auth('admin')->user()->franchise_id)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
        $order_summary->last_month = Order::where('order_for_franchise', '=', auth('admin')->user()->franchise_id)
            ->whereMonth('created_at', Carbon::now()->month-1)
            ->count();
        return $order_summary;
    }

    if (auth('admin')->check()) {
        $order_summary->pending = Order::where('order_progress', '=', 'pending')->whereNull('order_for_franchise')->count();
        $order_summary->today = Order::whereDate('created_at', '=', Carbon::today())->whereNull('order_for_franchise')->count();
        $order_summary->this_month = Order::whereMonth('created_at', Carbon::now()->month)->whereNull('order_for_franchise')->count();
        $order_summary->last_month = Order::whereMonth('created_at', Carbon::now()->month-1)->whereNull('order_for_franchise')->count();

        return $order_summary;
    }
    return null;
}

// create new order no
/**
 * @return int
 */
function createOrderNo() {
    $latest = Order::latest('order_no')->first();
    $today_order_init = substr(date('Y'), 2) . date('m') . date('d');

    if(!$latest || substr($latest->order_no, 0, 6) != $today_order_init) {
        $order_sr = str_pad(1, 3, '0', STR_PAD_LEFT);
        $order_no = $today_order_init . '1' . $order_sr;
    }
    else {
        $order_no = (string) ((int) $latest->order_no + 1);
    }
    return (int) $order_no;
}

/**
 * @param float $original
 * @param float|null $d_amount
 * @param float|null $d_percentage
 * @return float
 */
function getDiscountedAmount(float $original, float $d_amount = null, float $d_percentage = null) : float {
    $output = number_format((float)$original, 2, '.', '');
    if($d_amount && $d_amount > 0) {
        $output = ((float)$original) - ((float)$d_amount);
        $output = number_format($output, 2, '.', '');
    }
    else if($d_percentage) {
        $output = ((float)$original) * ((float)$d_percentage / 100);
        $output = ((float)$original) - $output;
        $output = number_format($output, 2, '.', '');
    }
    return $output;
}

/**
 * @param $number
 * @param int $decimals
 * @return float
 */
function getFixedDecimalFloat($number, $decimals = 2) : float {
    return number_format(((float) $number), $decimals, '.', '');
}


/**
 * @param int|array $products_id
 * @return array|int|null
 */
function getProductsBrands($products_id) {
    if(!is_array($products_id) && is_int($products_id)) {
        $product = \App\Models\Product::find($products_id);
        if(!$product) {
            return null;
        }
        if($product->brand) {
            return $product->brand->pb_id;
        }
    }
    if(is_array($products_id)) {
        $brands_id = [];
        $products = \App\Models\Product::find($products_id);
        if(!$products) {
            return null;
        }
        foreach($products as $product) {
            if($product->brand && !in_array($product->brand->pb_id, $brands_id)) {
                array_push($brands_id, $product->brand->pb_id);
            }
        }
        if(count($brands_id) <= 0) {
            return null;
        }
        return $brands_id;
    }
    return null;
}

/**
 * @param string|array|null $to
 * @param string|null $msg
 * @return MobileSms|void
 */
function mobileSms($to = null, string $msg = null) {
    $sms = new MobileSms();
    if(!$to) {
        return $sms;
    }
    try {
        return $sms->sendMessage($to, $msg);
    } catch (InvalidMethodException $e) {
        echo $e->getMessage();
    }
}


/**
 * @param string $mobile
 * @param string $order_no
 * @return MobileSms|void
 */
function sendOrderReceivedMsg(string $mobile, string $order_no) {
    $msg = "Thanks for placing order with us. Your Order No: #";
    $msg .= ($order_no . ". You'll receive a call shortly to verify your order.\n-");
    $msg .= getSiteBasic('site_title');

    return mobileSms($mobile, $msg);
}

function sendOrderConfirmedMsg(string $mobile, string $order_no) {
    $msg = "Your Order #" . $order_no . " has been confirmed. \nHave a good day.\n-";
    $msg .= getSiteBasic('site_title');

    return mobileSms($mobile, $msg);
}

function sendOrderDeliveredMsg(string $mobile, string $order_no) {
    $msg = "Your Order #" . $order_no . " has been successfully delivered.\n";
    $msg .= ("If you've any complain or query please call " . mobileNumber(getSiteBasic('site_mobile')));
    $msg .= ".\nThanks for shopping with us.\n-";
    $msg .= getSiteBasic('site_title');

    return mobileSms($mobile, $msg);
}

function generateReferralCode() {
    $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $res = '';

    while (true) {
        for ($i = 0; $i < 8; $i++) {
            $res .= $chars[mt_rand(0, strlen($chars)-1)];
        }
        $exists = Coupon::whereCouponCode($res)->first();
        if(!$exists) {
            break;
        }
    }

    return $res;
}

/**
 * @param string $latest
 * @return string
 */
function generateFranchiseCode(string $latest = 'FRA1001000') :string {
    $num = Str::after($latest, 'FRA');
    $num = (int) $num;
    $num += 10;

    return 'FRA' . $num;
}
