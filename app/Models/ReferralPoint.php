<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralPoint extends Model
{
    protected $primaryKey = 'point_id';

    /**
     * Get the log of the Referral Point
     *
     * @param  string  $value
     * @return array
     */
    public function getMethodLogAttribute($value) {
        return convertStringToArray($value, true);
    }

    /**
     * Get the log of the Referral Point
     *
     * @param  array  $value
     * @return void
     */
    public function setMethodLogAttribute($value)
    {
        $this->attributes['point_log'] = convertArrayToString($value, true);
    }
}
