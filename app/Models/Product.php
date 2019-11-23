<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    /**
     * The table primary key.
     */
    protected $primaryKey  = 'product_id';

    protected $appends = ['product_discounted_price'];

    protected $hidden = ['product_secret', 'product_log'];

    public function getProductDiscountedPriceAttribute()
    {
        return ($this->product_discounted)
            ? getDiscountedAmount($this->product_unit_mrp, $this->product_discount_amount, $this->product_discount_percentage)
            : null;
    }

    /*
     * Get the categories for the product
     */
    public function categories() {
        return $this->belongsToMany('App\Models\Category', 'product_categories', 'pc_product_id', 'pc_category_id');
    }

    /*
     * Get the brand for the product
     */
    public function brand() {
        return $this->belongsTo('App\Models\ProductBrand', 'product_vendor', 'pb_id')->withDefault();
    }

    public function getProductAvailableColorsAttribute($value) {
        return ($value !== null && strlen($value) > 5) ? convertStringToArray($value) : null;
    }

    public function getProductAvailableSizesAttribute($value) {
        return ($value !== null && strlen($value) > 5) ? convertStringToArray($value) : null;
    }

    public function franchises() {
        return $this->belongsToMany(Admin::class, 'franchise_stores', 'fs_product_id', 'fs_admin_id')
            ->withPivot('fs_stock')
            ->wherePivot('fs_stock', '>', 0);
    }

    public function franchiseStore() {
        return $this->hasMany(FranchiseStore::class, 'fs_product_id', 'product_id');
    }

    public function franchiseStock() {
        return $this->franchiseStore && $this->franchiseStore()->where('fs_admin_id', '=', auth('admin')->id())->first()
            ? $this->franchiseStore()->where('fs_admin_id', '=', auth('admin')->id())->first()->fs_stock
            : 0;
    }
}
