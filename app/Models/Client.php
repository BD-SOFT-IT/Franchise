<?php

namespace App\Models;

use App\Notifications\ClientResetPassword;
use App\Notifications\ClientVerifyEmail;
use App\Notifications\ClientVerifyMobile;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use Notifiable;

    protected $primaryKey  = 'client_id';

    protected $appends = ['full_name'];

    protected $hidden = [
        'password', 'remember_token', 'provider', 'provider_id', 'app_api_agent', 'verification_code'
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new ClientVerifyEmail);
    }

    public function routeNotificationForMobileSms() {
        return $this->mobile;
    }

    /**
     * Send the mobile verification notification.
     *
     * @param $token
     * @return void
     */
    public function sendMobileVerificationNotification($token)
    {
        $this->notify(new ClientVerifyMobile($token));
    }

    /**
     * Send the email verification notification.
     *
     * @param $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ClientResetPassword($token));
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function orders() {
        return $this->hasMany('App\Models\Order', 'order_client_id', 'client_id');
    }

    public function membership()
    {
        return $this->hasOne('App\Models\Membership', 'membership_client_id', 'client_id');
    }


    public function shoppingBag()
    {
        return $this->hasOne('App\Models\ShoppingBag', 'sb_client_id');
    }

    public function referral() {
        return $this->hasOne(Coupon::class, 'coupon_referrer_id', 'client_id');
    }

    public function referralPoint() {
        return $this->hasOne(ReferralPoint::class, 'point_client', 'client_id');
    }

    public function couponHistories()
    {
        return $this->hasMany('App\Models\CouponHistory', 'ch_client_id', 'client_id');
    }

    public function apiAgent() {
        return $this->hasOne('App\Models\ApiAgent', 'app_api_agent');
    }
}
