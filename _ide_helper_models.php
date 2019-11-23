<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Admin
 *
 * @property int $id
 * @property string|null $franchise_id
 * @property string $first_name
 * @property string $last_name
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $img_url
 * @property string|null $address
 * @property string|null $city
 * @property string|null $country
 * @property int|null $postcode
 * @property string|null $mobile_primary
 * @property string|null $mobile_secondary
 * @property int $role_id
 * @property int $active
 * @property int|null $creator_id
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $franchiseOrders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $franchiseProducts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $franchiseSelfOrders
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\Models\AdminRole $role
 * @property-read \App\Models\Shipper $shipper
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereFranchiseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereImgUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereMobilePrimary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereMobileSecondary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin wherePostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereUpdatedAt($value)
 */
	class Admin extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AdminRole
 *
 * @property int $ar_id
 * @property string $ar_title
 * @property string $ar_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin[] $admins
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminRole whereArId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminRole whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminRole whereArTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminRole whereUpdatedAt($value)
 */
	class AdminRole extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ApiAgent
 *
 * @property int $agent_id
 * @property int $agent_creator_id
 * @property string $agent_api_key
 * @property string $agent_api_secret
 * @property string $agent_type
 * @property string $agent_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Client[] $clients
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApiAgent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApiAgent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApiAgent query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApiAgent whereAgentApiKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApiAgent whereAgentApiSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApiAgent whereAgentCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApiAgent whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApiAgent whereAgentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApiAgent whereAgentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApiAgent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApiAgent whereUpdatedAt($value)
 */
	class ApiAgent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Banner
 *
 * @property int $banner_id
 * @property int $banner_creator_id
 * @property string $banner_name
 * @property string $banner_type
 * @property string $banner_position
 * @property string|null $banner_title
 * @property string|null $banner_description
 * @property string|null $banner_img
 * @property string|null $banner_target_text
 * @property string|null $banner_code
 * @property string|null $banner_provider
 * @property string|null $banner_target_url
 * @property string|null $banner_target_url_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereBannerCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereBannerCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereBannerDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereBannerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereBannerImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereBannerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereBannerPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereBannerProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereBannerTargetText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereBannerTargetUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereBannerTargetUrlType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereBannerTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereBannerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereUpdatedAt($value)
 */
	class Banner extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Category
 *
 * @property int $category_id
 * @property int $category_creator_id
 * @property string $category_title
 * @property string|null $category_title_bangla
 * @property string $category_description
 * @property string $category_slug
 * @property string $category_type
 * @property string|null $category_img
 * @property int|null $category_parent_id
 * @property int $category_active
 * @property string|null $category_log
 * @property float $category_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCategoryActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCategoryCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCategoryDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCategoryImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCategoryLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCategoryOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCategoryParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCategorySlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCategoryTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCategoryTitleBangla($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCategoryType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Client
 *
 * @property int $client_id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $email
 * @property string|null $mobile
 * @property string|null $mobile_secondary
 * @property string|null $password
 * @property string|null $blood_group
 * @property string|null $provider
 * @property string|null $provider_id
 * @property string|null $img_url
 * @property string|null $billing_address
 * @property string|null $billing_area
 * @property string|null $billing_city
 * @property string|null $billing_state
 * @property string|null $billing_country
 * @property int|null $billing_postcode
 * @property string|null $email_verified_at
 * @property string|null $verification_code
 * @property int $active
 * @property int|null $app_api_agent
 * @property string|null $settings
 * @property string|null $log
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ApiAgent $apiAgent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CouponHistory[] $couponHistories
 * @property-read string $full_name
 * @property-read \App\Models\Membership $membership
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read \App\Models\Coupon $referral
 * @property-read \App\Models\ReferralPoint $referralPoint
 * @property-read \App\Models\ShoppingBag $shoppingBag
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereAppApiAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereBillingAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereBillingArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereBillingCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereBillingCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereBillingPostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereBillingState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereBloodGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereImgUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereMobileSecondary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereSettings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereVerificationCode($value)
 */
	class Client extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClientAccountBalance
 *
 * @property int $cab_id
 * @property int $cab_client_id
 * @property float|null $cab_debited
 * @property string|null $cab_debited_by
 * @property int|null $cab_debited_by_order_id
 * @property float|null $cab_credited
 * @property string|null $cab_credited_by
 * @property int|null $cab_credited_by_coupon_code
 * @property int|null $cab_credited_by_membership_point_id
 * @property int|null $cab_credited_by_payment_id
 * @property float $cab_balance
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientAccountBalance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientAccountBalance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientAccountBalance query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientAccountBalance whereCabBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientAccountBalance whereCabClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientAccountBalance whereCabCredited($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientAccountBalance whereCabCreditedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientAccountBalance whereCabCreditedByCouponCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientAccountBalance whereCabCreditedByMembershipPointId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientAccountBalance whereCabCreditedByPaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientAccountBalance whereCabDebited($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientAccountBalance whereCabDebitedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientAccountBalance whereCabDebitedByOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientAccountBalance whereCabId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientAccountBalance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientAccountBalance whereUpdatedAt($value)
 */
	class ClientAccountBalance extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Coupon
 *
 * @property int $coupon_id
 * @property string $coupon_code
 * @property float|null $coupon_discount_amount
 * @property float|null $coupon_discount_percentage
 * @property float|null $coupon_max_amount
 * @property float|null $coupon_min_order_amount
 * @property string $coupon_type
 * @property int|null $coupon_referrer_id
 * @property string|null $coupon_note
 * @property string|null $coupon_log
 * @property string $coupon_started
 * @property string|null $coupon_expired
 * @property int $coupon_active
 * @property int|null $coupon_max_use_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CouponHistory[] $couponHistories
 * @property-read \App\Models\Client|null $referrer
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereCouponActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereCouponCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereCouponDiscountAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereCouponDiscountPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereCouponExpired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereCouponLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereCouponMaxAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereCouponMaxUseTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereCouponMinOrderAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereCouponNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereCouponReferrerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereCouponStarted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereCouponType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupon whereUpdatedAt($value)
 */
	class Coupon extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CouponHistory
 *
 * @property int $ch_id
 * @property int $ch_client_id
 * @property string $ch_coupon_code
 * @property int|null $ch_used_order_id
 * @property string $ch_used_at
 * @property-read \App\Models\Client $client
 * @property-read \App\Models\Coupon $coupon
 * @property-read \App\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponHistory whereChClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponHistory whereChCouponCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponHistory whereChId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponHistory whereChUsedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponHistory whereChUsedOrderId($value)
 */
	class CouponHistory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DeliveryLocation
 *
 * @property int $location_id
 * @property int $location_admin_id
 * @property string $location_type
 * @property string $location_name
 * @property string $location_name_bengali
 * @property int|null $location_parent
 * @property int $location_selected
 * @property string $location_log
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Admin $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DeliverySchedule[] $schedules
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryLocation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryLocation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryLocation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryLocation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryLocation whereLocationAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryLocation whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryLocation whereLocationLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryLocation whereLocationName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryLocation whereLocationNameBengali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryLocation whereLocationParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryLocation whereLocationSelected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryLocation whereLocationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryLocation whereUpdatedAt($value)
 */
	class DeliveryLocation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DeliveryMethod
 *
 * @property int $method_id
 * @property string $method_name
 * @property float $method_charge
 * @property int $method_available_outside
 * @property int $method_active
 * @property string|null $method_time
 * @property string|null $method_note
 * @property array $method_log
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryMethod whereMethodActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryMethod whereMethodAvailableOutside($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryMethod whereMethodCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryMethod whereMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryMethod whereMethodLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryMethod whereMethodName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryMethod whereMethodNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryMethod whereMethodTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryMethod whereUpdatedAt($value)
 */
	class DeliveryMethod extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DeliverySchedule
 *
 * @property int $schedule_id
 * @property string|null $schedule_expected_time_from
 * @property string|null $schedule_expected_time_to
 * @property string|null $schedule_time_range_bengali
 * @property float|null $schedule_expected_hour_from
 * @property float|null $schedule_expected_hour_to
 * @property string $schedule_log
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DeliveryLocation[] $locations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliverySchedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliverySchedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliverySchedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliverySchedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliverySchedule whereScheduleExpectedHourFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliverySchedule whereScheduleExpectedHourTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliverySchedule whereScheduleExpectedTimeFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliverySchedule whereScheduleExpectedTimeTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliverySchedule whereScheduleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliverySchedule whereScheduleLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliverySchedule whereScheduleTimeRangeBengali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliverySchedule whereUpdatedAt($value)
 */
	class DeliverySchedule extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FranchiseStore
 *
 * @property int $fs_id
 * @property int $fs_product_id
 * @property int $fs_admin_id
 * @property int $fs_stock
 * @property string|null $fs_sizes
 * @property string|null $fs_colors
 * @property string|null $fs_log
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\Admin $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FranchiseStore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FranchiseStore newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FranchiseStore query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FranchiseStore whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FranchiseStore whereFsAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FranchiseStore whereFsColors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FranchiseStore whereFsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FranchiseStore whereFsLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FranchiseStore whereFsProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FranchiseStore whereFsSizes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FranchiseStore whereFsStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FranchiseStore whereUpdatedAt($value)
 */
	class FranchiseStore extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Job
 *
 * @property int $id
 * @property string $queue
 * @property string $payload
 * @property int $attempts
 * @property int|null $reserved_at
 * @property int $available_at
 * @property \Illuminate\Support\Carbon $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereAttempts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereAvailableAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereQueue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereReservedAt($value)
 */
	class Job extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Membership
 *
 * @property int $membership_id
 * @property int|null $membership_client_id
 * @property string $membership_type
 * @property int $membership_active
 * @property string $membership_log
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client|null $client
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MembershipPoint[] $membershipPoints
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Membership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Membership newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Membership query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Membership whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Membership whereMembershipActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Membership whereMembershipClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Membership whereMembershipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Membership whereMembershipLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Membership whereMembershipType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Membership whereUpdatedAt($value)
 */
	class Membership extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MembershipPoint
 *
 * @property int $mp_id
 * @property int $mp_membership_id
 * @property string|null $mp_order_no
 * @property string $mp_type
 * @property float $mp_exchanged
 * @property float $mp_total
 * @property \Illuminate\Support\Carbon $created_at
 * @property-read \App\Models\Membership $membership
 * @property-read \App\Models\Order|null $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MembershipPoint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MembershipPoint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MembershipPoint query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MembershipPoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MembershipPoint whereMpExchanged($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MembershipPoint whereMpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MembershipPoint whereMpMembershipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MembershipPoint whereMpOrderNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MembershipPoint whereMpTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MembershipPoint whereMpType($value)
 */
	class MembershipPoint extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Notification
 *
 * @property int $id
 * @property string $type
 * @property string $notifiable_type
 * @property int $notifiable_id
 * @property string $data
 * @property string|null $app_type
 * @property string|null $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereAppType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereNotifiableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereNotifiableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereUpdatedAt($value)
 */
	class Notification extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @property int $order_id
 * @property string $order_no
 * @property int|null $order_client_id
 * @property string|null $order_for_franchise
 * @property string|null $order_by_franchise
 * @property string|null $order_shipping_datetime
 * @property int|null $order_shipping_method
 * @property int|null $order_shipper_id
 * @property string $order_shipping_person
 * @property string $order_shipping_phone
 * @property string $order_shipping_address
 * @property string $order_shipping_area
 * @property string $order_shipping_city
 * @property string $order_shipping_state
 * @property string $order_shipping_country
 * @property int|null $order_shipping_postcode
 * @property float $order_vat
 * @property float $order_products_total
 * @property float|null $order_coupon_code_discount
 * @property float $order_total
 * @property float $order_total_paid_with_account
 * @property float $order_total_due
 * @property string $order_payment_type
 * @property string $order_payment_status
 * @property string $order_progress
 * @property string|null $order_secret
 * @property string $order_created_by
 * @property string|null $order_log
 * @property string|null $order_note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Admin|null $byFranchise
 * @property-read \App\Models\Client|null $client
 * @property-read \App\Models\CouponHistory $couponHistory
 * @property-read \App\Models\Admin|null $forFranchise
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MembershipPoint[] $membershipPoints
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderDetail[] $orderDetails
 * @property-read \App\Models\Shipper|null $shipper
 * @property-read \App\Models\DeliveryMethod|null $shippingMethod
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderByFranchise($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderCouponCodeDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderForFranchise($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderPaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderPaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderProductsTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderProgress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderShipperId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderShippingAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderShippingArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderShippingCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderShippingCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderShippingDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderShippingMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderShippingPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderShippingPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderShippingPostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderShippingState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderTotalDue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderTotalPaidWithAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderVat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUpdatedAt($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderDetail
 *
 * @property int $od_id
 * @property int $od_order_id
 * @property int $od_product_id
 * @property string|null $od_product_size
 * @property string|null $od_product_color
 * @property float $od_product_unit_cost
 * @property float $od_product_unit_mrp
 * @property int $od_product_quantity
 * @property float|null $od_product_discount_amount
 * @property float|null $od_product_discount_percentage
 * @property float $od_product_total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDetail whereOdId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDetail whereOdOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDetail whereOdProductColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDetail whereOdProductDiscountAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDetail whereOdProductDiscountPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDetail whereOdProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDetail whereOdProductQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDetail whereOdProductSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDetail whereOdProductTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDetail whereOdProductUnitCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDetail whereOdProductUnitMrp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDetail whereUpdatedAt($value)
 */
	class OrderDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Payment
 *
 * @property int $payment_id
 * @property string $payment_transaction_no
 * @property int $payment_client_id
 * @property int $payment_order_no
 * @property string $payment_type
 * @property string $payment_status
 * @property string|null $payment_error
 * @property float $payment_total
 * @property float $payment_fees
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePaymentClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePaymentError($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePaymentFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePaymentOrderNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePaymentTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePaymentTransactionNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereUpdatedAt($value)
 */
	class Payment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Post
 *
 * @property int $post_id
 * @property int $post_admin_id
 * @property string $post_title
 * @property string $post_slug
 * @property string|null $post_keywords
 * @property string|null $post_meta_description
 * @property string|null $post_description
 * @property int $post_active
 * @property string $post_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Admin $author
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePostActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePostAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePostDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePostKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePostMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePostSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePostTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePostType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereUpdatedAt($value)
 */
	class Post extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property int $product_id
 * @property string $product_sku
 * @property int|null $product_vendor
 * @property string|null $product_vendor_sku
 * @property string $product_title
 * @property string|null $product_title_bengali
 * @property string $product_slug
 * @property string $product_description
 * @property string|null $product_description_bengali
 * @property string|null $product_description_app
 * @property string|null $product_description_bengali_app
 * @property string $product_categories
 * @property string|null $product_description_short
 * @property string|null $product_keywords
 * @property string $product_unit_name
 * @property float $product_unit_quantity
 * @property float $product_unit_cost
 * @property float $product_unit_mrp
 * @property float|null $product_unit_mrp_franchise
 * @property string|null $product_available_sizes
 * @property string|null $product_available_colors
 * @property float|null $product_discount_amount
 * @property float|null $product_discount_percentage
 * @property int|null $product_units_in_stock
 * @property int $product_units_min_franchise
 * @property int $product_units_max_selection
 * @property int $product_unit_subtract_on_order
 * @property float $product_rank
 * @property string $product_availability_status
 * @property int $product_replacement_available
 * @property string|null $product_guarantee_time
 * @property string $product_guarantee_status
 * @property int $product_active
 * @property int $product_featured
 * @property int $product_offered
 * @property int $product_discounted
 * @property int $product_available_outside
 * @property int $product_total_unit_sold
 * @property string|null $product_img_main
 * @property string|null $product_img_2
 * @property string|null $product_img_3
 * @property string|null $product_img_4
 * @property string|null $product_img_5
 * @property string|null $product_logs
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ProductBrand|null $brand
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FranchiseStore[] $franchiseStore
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin[] $franchises
 * @property-read mixed $product_discounted_price
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductAvailabilityStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductAvailableColors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductAvailableOutside($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductAvailableSizes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductCategories($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductDescriptionApp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductDescriptionBengali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductDescriptionBengaliApp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductDescriptionShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductDiscountAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductDiscountPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductDiscounted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductGuaranteeStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductGuaranteeTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductImg2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductImg3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductImg4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductImg5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductImgMain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductLogs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductOffered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductReplacementAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductTitleBengali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductTotalUnitSold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductUnitCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductUnitMrp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductUnitMrpFranchise($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductUnitName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductUnitQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductUnitSubtractOnOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductUnitsInStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductUnitsMaxSelection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductUnitsMinFranchise($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductVendor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductVendorSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductBrand
 *
 * @property int $pb_id
 * @property string $pb_name
 * @property string|null $pb_name_bengali
 * @property string|null $pb_img
 * @property string|null $pb_website
 * @property string|null $pb_phone
 * @property string|null $pb_email
 * @property string|null $pb_log
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductBrand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductBrand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductBrand query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductBrand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductBrand wherePbEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductBrand wherePbId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductBrand wherePbImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductBrand wherePbLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductBrand wherePbName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductBrand wherePbNameBengali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductBrand wherePbPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductBrand wherePbWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductBrand whereUpdatedAt($value)
 */
	class ProductBrand extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductCategory
 *
 * @property int $pc_id
 * @property int $pc_category_id
 * @property int $pc_product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory wherePcCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory wherePcId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory wherePcProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory whereUpdatedAt($value)
 */
	class ProductCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductReview
 *
 * @property int $pr_id
 * @property int $pr_client_id
 * @property int|null $pr_product_id
 * @property float $pr_rank
 * @property string|null $pr_comment
 * @property int $pr_active
 * @property int|null $pr_approved_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview wherePrActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview wherePrApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview wherePrClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview wherePrComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview wherePrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview wherePrProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview wherePrRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview whereUpdatedAt($value)
 */
	class ProductReview extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductSupply
 *
 * @property int $ps_id
 * @property int $ps_creator_id
 * @property int|null $ps_supplier_id
 * @property float $ps_total_price
 * @property string $ps_payment_status
 * @property float $ps_price_paid
 * @property float $ps_price_due
 * @property int $ps_full_paid
 * @property string|null $ps_complete_date
 * @property string|null $ps_modifier_id_list
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupply query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupply wherePsCompleteDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupply wherePsCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupply wherePsFullPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupply wherePsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupply wherePsModifierIdList($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupply wherePsPaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupply wherePsPriceDue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupply wherePsPricePaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupply wherePsSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupply wherePsTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupply whereUpdatedAt($value)
 */
	class ProductSupply extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductSupplyDetail
 *
 * @property int $psd_id
 * @property int $psd_ps_id
 * @property string $psd_sku
 * @property string $psd_unit
 * @property float $psd_quantity_per_unit
 * @property float $psd_unit_price
 * @property float $psd_unit_mrp
 * @property string|null $psd_size
 * @property string|null $psd_color
 * @property float $psd_discount
 * @property float $psd_total_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupplyDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupplyDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupplyDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupplyDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupplyDetail wherePsdColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupplyDetail wherePsdDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupplyDetail wherePsdId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupplyDetail wherePsdPsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupplyDetail wherePsdQuantityPerUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupplyDetail wherePsdSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupplyDetail wherePsdSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupplyDetail wherePsdTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupplyDetail wherePsdUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupplyDetail wherePsdUnitMrp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupplyDetail wherePsdUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSupplyDetail whereUpdatedAt($value)
 */
	class ProductSupplyDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ReferralPoint
 *
 * @property int $point_id
 * @property int $point_client
 * @property int $point_value
 * @property string|null $point_log
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array $method_log
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferralPoint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferralPoint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferralPoint query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferralPoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferralPoint wherePointClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferralPoint wherePointId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferralPoint wherePointLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferralPoint wherePointValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferralPoint whereUpdatedAt($value)
 */
	class ReferralPoint extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RefusedProduct
 *
 * @property int $rp_id
 * @property int $rp_product_id
 * @property int $rp_admin_id
 * @property string $rp_type
 * @property float $rp_product_unit_cost
 * @property int $rp_product_total_unit
 * @property int|null $rp_order_id
 * @property string|null $rp_note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefusedProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefusedProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefusedProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefusedProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefusedProduct whereRpAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefusedProduct whereRpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefusedProduct whereRpNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefusedProduct whereRpOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefusedProduct whereRpProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefusedProduct whereRpProductTotalUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefusedProduct whereRpProductUnitCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefusedProduct whereRpType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefusedProduct whereUpdatedAt($value)
 */
	class RefusedProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Shipper
 *
 * @property int $shipper_id
 * @property int|null $shipper_user_id
 * @property string $shipper_name
 * @property string $shipper_company
 * @property string|null $shipper_website
 * @property string $shipper_address
 * @property string $shipper_phone
 * @property string|null $shipper_phone_alt
 * @property string|null $shipper_email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Admin|null $admin
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shipper newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shipper newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shipper query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shipper whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shipper whereShipperAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shipper whereShipperCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shipper whereShipperEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shipper whereShipperId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shipper whereShipperName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shipper whereShipperPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shipper whereShipperPhoneAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shipper whereShipperUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shipper whereShipperWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shipper whereUpdatedAt($value)
 */
	class Shipper extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ShoppingBag
 *
 * @property int $sb_id
 * @property int $sb_client_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingBag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingBag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingBag query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingBag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingBag whereSbClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingBag whereSbId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingBag whereUpdatedAt($value)
 */
	class ShoppingBag extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ShoppingBagProduct
 *
 * @property int $sbp_id
 * @property int $sbp_shopping_bag_id
 * @property int $sbp_product_id
 * @property int $sbp_product_total_unit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingBagProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingBagProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingBagProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingBagProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingBagProduct whereSbpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingBagProduct whereSbpProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingBagProduct whereSbpProductTotalUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingBagProduct whereSbpShoppingBagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingBagProduct whereUpdatedAt($value)
 */
	class ShoppingBagProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SiteOption
 *
 * @property int $so_id
 * @property int $so_modifier_id
 * @property string $so_name
 * @property string|null $so_content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteOption whereSoContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteOption whereSoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteOption whereSoModifierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteOption whereSoName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteOption whereUpdatedAt($value)
 */
	class SiteOption extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Supplier
 *
 * @property int $supplier_id
 * @property string $supplier_name
 * @property string $supplier_contact_name
 * @property string $supplier_contact_title
 * @property string|null $supplier_address_1
 * @property string|null $supplier_address_2
 * @property string|null $supplier_city
 * @property int|null $supplier_postcode
 * @property string|null $supplier_country
 * @property string|null $supplier_phone
 * @property string|null $supplier_phone_alt
 * @property string $supplier_contact_phone
 * @property string|null $supplier_fax
 * @property string|null $supplier_email
 * @property string|null $supplier_web
 * @property string $supplier_payment_method
 * @property int $supplier_products_category_id
 * @property string|null $supplier_note
 * @property string|null $supplier_logo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSupplierAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSupplierAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSupplierCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSupplierContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSupplierContactPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSupplierContactTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSupplierCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSupplierEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSupplierFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSupplierLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSupplierName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSupplierNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSupplierPaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSupplierPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSupplierPhoneAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSupplierPostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSupplierProductsCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereSupplierWeb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier whereUpdatedAt($value)
 */
	class Supplier extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WishList
 *
 * @property int $wl_id
 * @property int $wl_client_id
 * @property int $wl_product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client $client
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishList query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishList whereWlClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishList whereWlId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WishList whereWlProductId($value)
 */
	class WishList extends \Eloquent {}
}

