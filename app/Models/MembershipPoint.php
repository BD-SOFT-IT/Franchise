<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class MembershipPoint extends Model
{
    protected $primaryKey = 'mp_id';

    /**
     * Get the membership for the point
     */
    public function membership()
    {
        return $this->belongsTo('App\Models\Membership', 'mp_membership_id');
    }

    /**
     * Get the order for the point
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'mp_order_no', 'order_no');
    }
}
