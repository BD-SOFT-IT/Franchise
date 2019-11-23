<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Membership extends Model
{
    protected $primaryKey = 'membership_id';

    /**
     * Get the membership points of the membership
     */
    public function membershipPoints()
    {
        return $this->hasMany('App\Models\MembershipPoint', 'mp_membership_id', 'membership_id');
    }

    /**
     * Get the client who owns the membership
     */
    public function client() {
        return $this->belongsTo('App\Models\Client', 'membership_client_id', 'client_id');
    }
}
