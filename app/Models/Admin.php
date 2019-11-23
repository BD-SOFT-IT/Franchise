<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordNotification;


class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';


    protected $fillable = [
        'first_name', 'last_name', 'name', 'email', 'password', 'role_id', 'active'
    ];


    protected $hidden = [
        'password', 'remember_token'
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }


    public function role() {
        return $this->belongsTo('App\Models\AdminRole', 'role_id');
    }

    public function shipper() {
        return $this->hasOne('App\Models\Shipper', 'shipper_user_id');
    }

    public function isSuperAdmin() {
        return ($this->role->ar_name == 'super_admin');
    }

    public function isAdmin() {
        return ($this->role->ar_name == 'admin');
    }

    public function isAlpha() {
        return ($this->role->ar_name == 'alpha');
    }

    public function isManager() {
        return ($this->role->ar_name == 'manager');
    }

    public function isCustomerManager() {
        return ($this->role->ar_name == 'customer_manager');
    }

    public function isStoreKeeper() {
        return ($this->role->ar_name == 'store_keeper');
    }

    public function isShipper() {
        return ($this->role->ar_name == 'shipper');
    }

    public function isFranchise() {
        return ($this->role->ar_name == 'franchise');
    }

    public function franchiseProducts() {
        return $this->belongsToMany(Product::class, 'franchise_stores', 'fs_admin_id', 'fs_product_id')
            ->withPivot('fs_stock');
    }

    public function franchiseSelfOrders() {
        return $this->hasMany(Order::class, 'order_by_franchise', 'franchise_id');
    }

    public function franchiseOrders() {
        return $this->hasMany(Order::class, 'order_for_franchise', 'franchise_id');
    }

    public function routeNotificationForMobileSms() {
        return $this->mobile_primary;
    }

}
