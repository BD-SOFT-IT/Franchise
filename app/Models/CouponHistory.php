<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponHistory extends Model
{
    protected $primaryKey = 'ch_id';

    public $timestamps = false;

    /**
     * Get the client who used the coupon
     */
    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'ch_client_id', 'client_id');
    }

    /**
     * Get the coupon for the history
     */
    public function coupon()
    {
        return $this->belongsTo('App\Models\Coupon', 'ch_coupon_code', 'coupon_code');
    }

    public function order() {
        return $this->hasOne('App\Models\Order', 'ch_used_order_id', 'order_id');
    }
}
