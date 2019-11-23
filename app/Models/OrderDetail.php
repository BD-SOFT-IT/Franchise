<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class OrderDetail extends Model {

    /**
     * The table primary key.
     */
    protected $primaryKey  = 'od_id';


    /**
     * Get the order that owns the order details.
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'od_order_id', 'order_id');
    }

    /**
     * Get the product that for order detail.
     */
    public function product() {
        return $this->belongsTo('App\Models\Product', 'od_product_id', 'product_id');
    }
}
