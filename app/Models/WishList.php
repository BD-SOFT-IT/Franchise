<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class WishList extends Model
{
    /**
     * The table primary key.
     */
    protected $primaryKey  = 'wl_id';

    protected $fillable = ['wl_client_id', 'wl_product_id'];

    public function product() {
        return $this->belongsTo(Product::class, 'wl_product_id', 'product_id');
    }

    public function client() {
        return $this->hasOne(Client::class, 'wl_client_id', 'client_id');
    }
}
