<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Order extends Model {

    protected $primaryKey  = 'order_id';

    // Get the order progress
    public function isPending() {
        return (strtolower($this->order_progress) == 'pending');
    }

    public function isProcessing() {
        return (strtolower($this->order_progress) == 'processing');
    }

    public function isOnDelivery() {
        return (strtolower($this->order_progress) == 'on delivery');
    }

    public function isDelivered() {
        return (strtolower($this->order_progress) == 'delivered');
    }

    public function isCanceled() {
        return (strtolower($this->order_progress) == 'canceled');
    }

    public function log() {
        return convertStringToArray($this->order_log);
    }

    /**
     * Get the client that owns the order.
     */
    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'order_client_id', 'client_id');
    }

    /**
     * Get the order details of the client.
     */
    public function orderDetails() {
        return $this->hasMany('App\Models\OrderDetail', 'od_order_id', 'order_id');
    }

    /*
     * Get the Shipper for the Order
     */
    public function shipper() {
        return $this->belongsTo('App\Models\Shipper', 'order_shipper_id', 'shipper_id');
    }

    public function couponHistory() {
        return $this->hasOne('App\Models\CouponHistory', 'ch_used_order_id', 'order_id');
    }

    public function byFranchise() {
        return $this->belongsTo(Admin::class, 'order_by_franchise', 'franchise_id');
    }

    public function forFranchise() {
        return $this->belongsTo(Admin::class, 'order_for_franchise', 'franchise_id');
    }

    /**
     * Get the membership points of the client
     */
    public function membershipPoints()
    {
        return $this->hasMany('App\Models\MembershipPoint', 'mp_order_no', 'order_no');
    }

    /*
     * Order Shipping Method
     */
    public function shippingMethod() {
        return $this->belongsTo(DeliveryMethod::class, 'order_shipping_method', 'method_id');
    }
}
