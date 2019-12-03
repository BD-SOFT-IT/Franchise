<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Seller;

class SellerProduct extends Model
{
    protected $primaryKey = 'product_id';


    protected $fillable =
        ['product_title','product_description','product_category','product_unit',
        'product_unit_cost','product_unit_mrp','product_unit_stock','product_unit_availability',
            'product_discount'];

//    public function sellerProduct() {
//        return $this->belongsTo(Seller::class, 'bd_seller_id','seller_id');
//    }
}
