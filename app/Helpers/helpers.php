<?php
// All Helper Functions

use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Stevebauman\Location\Facades\Location;
use Illuminate\Database\Eloquent\Model;
use App\Models\Banner;
use Carbon\Carbon;
use App\Models\ApiAgent;
use App\Models\SiteOption;
use Illuminate\Http\Request;

// ///////////////////////////////////////////////
require 'shop_helper.php';
require 'array_string_helpers.php';
require 'theme.php';
require 'social_share.php';

// ///////////////////////////////////////////////

// get current temperature
/**
 * @return stdClass
 */
function getLocationInfo() {
    $location = Location::get();

    $json_url = 'http://api.openweathermap.org/data/2.5/weather?lat=' . $location->latitude . '&lon=' . $location->longitude . '&appid=' . config('app.open_weather_map_api');
    $json = file_get_contents($json_url);

    $weather = json_decode($json);
    $kelvin = $weather->main->temp;
    $celsius = $kelvin - 273.15;

    // Return a new standard class
    $info = new \stdClass();

    $info->country = $location->countryName;
    $info->city = $location->cityName;
    $info->temperature = $celsius;

    return $info;
}

/**
 * @param string|array $msg
 * @return JsonResponse
 */
function sendNotFoundJsonResponse($msg) {
    return response()->json([
        'code'      => 404,
        'message'   => 'not_found',
        'error'     => $msg
    ], 404);
}

/**
 * @return JsonResponse
 */
function sendServerErrorJsonResponse() {
    return response()->json([
        'code'      => 500,
        'message'   => 'server_error',
        'error'     => 'Something went wrong!'
    ], 500);
}

/**
 * @param Request $request
 * @return Builder|Model|object|null
 */
function getRequestApiAgent(Request $request) {
    $agent = ApiAgent::where('agent_api_key', '=', $request->header('RBT-API-KEY'))
        ->where('agent_api_secret', '=', $request->header('RBT-API-SECRET'))
        ->first();

    if(!$agent) {
        return null;
    }
    return $agent;
}


/**
 * @param string $name
 * @param null $default
 * @return string|null
 */
function getSiteBasic(string $name, $default = null) {
    $basic = SiteOption::whereSoName($name)->first();

    return ($basic) ? $basic->so_content : $default;
}

/**
 * @param string|null $img
 * @param string $template
 * @return UrlGenerator|string
 */
function imageCache(string $img = null, string $template = 'original') {
    return $img ? route('imagecache', ['template' => $template, 'filename' => $img]) : staticAsset('theme/images/logos/default_product.png');
}


/**
 * @param string $column
 * @param bool $byName
 * @param int $count
 * @return Banner|Banner[]|Model|object|null
 */
function getBanners(string $column, bool $byName = false, int $count = 2) {
    return ($byName)
        ? Banner::whereBannerName($column)->whereNotNull('banner_img')->first()
        : Banner::whereBannerPosition($column)
            ->whereNotNull('banner_img')
            ->orderBy('banner_name')
            ->take($count)
            ->get();
}


/**
 * @param array $data
 * @return bool | Coupon
 */
function validateCoupon(array $data) {
    $coupon = Coupon::whereCouponCode($data['coupon'])
        ->whereDate('coupon_started', '<=', Carbon::now()->toDateString())
        ->first();

    if(!auth()->check() || !$coupon || $coupon->expired()) {
        return false;
    }
    if($coupon->coupon_min_order_amount && $coupon->coupon_min_order_amount > $data['total']) {
        return false;
    }
    if($coupon->coupon_type === 'referral') {
        if($coupon->referrer->client_id === auth()->id() || !$coupon->referrer->hasVerifiedEmail()) {
            return false;
        }
    }

    if(!$histories = auth()->user()->couponHistories) {
        return $coupon;
    }
    foreach($histories as $history) {
        if($coupon->coupon_type === 'referral' && $history->coupon->coupon_type === 'referral') {
            return false;
            break;
        }
        if($history->coupon->coupon_code === $coupon->coupon_code) {
            return false;
            break;
        }
    }
    return $coupon;
}

/**
 * @param int $product_id
 * @param int $count
 * @return Collection|null
 */
function getRelatedProducts(int $product_id, int $count = 5) {
    $product = Product::find($product_id);
    if(!$product) {
        return null;
    }
    $products = collect();
    $cats = ['filtering', 'child', 'parent'];
    foreach ($cats as $cat) {
        $category = $product->categories()
            ->where('category_type', '=', $cat)
            ->first();
        if($category && $category->products) {
            foreach ($category->products as $i => $p) {
                $products->push($p);
                if($i == ($count - 1)) {
                    break;
                }
            }
        }
        if($products->count() >= $count) {
            break;
        }
    }
    return $products;
}


