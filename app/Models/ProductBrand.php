<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ProductBrand extends Model
{
    protected $primaryKey = 'pb_id';

    /*
     *  Get products for the brand
     */
    public function products() {
        return $this->hasMany('App\Models\Product', 'product_vendor', 'pb_id');
    }
}
