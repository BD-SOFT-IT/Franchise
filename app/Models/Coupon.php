<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $primaryKey = 'coupon_id';

    /**
     * Get the coupon history
     */
    public function couponHistories() {
        return $this->hasMany(CouponHistory::class, 'ch_coupon_code', 'coupon_code');
    }

    public function referrer() {
        return $this->belongsTo(Client::class, 'coupon_referrer_id', 'client_id');
    }

    public function expired() {
        return ($this->coupon_expired && Carbon::parse($this->coupon_expired)->diffInHours(Carbon::now(), false) > 0)
            || ($this->couponHistories && $this->couponHistories->count() === $this->coupon_max_use_time);
    }
}
