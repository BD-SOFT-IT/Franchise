<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryMethod extends Model
{
    protected $primaryKey = 'method_id';

    /**
     * Get the log of the Delivery Method
     *
     * @param  string  $value
     * @return array
     */
    public function getMethodLogAttribute($value) {
        return convertStringToArray($value, true);
    }

    /**
     * Get the log of the Delivery Method
     *
     * @param  array  $value
     * @return void
     */
    public function setMethodLogAttribute($value)
    {
        $this->attributes['method_log'] = convertArrayToString($value, true);
    }
}
