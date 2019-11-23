<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Shipper extends Model {

    protected $primaryKey = 'shipper_id';

    /*
     * Get the Orders for the Shipper
     */
    public function orders() {
        return $this->hasMany('App\Models\Order', 'order_shipper_id', 'shipper_id');
    }

    public function admin() {
        return $this->belongsTo('App\Models\Admin', 'shipper_user_id');
    }

}
