<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliverySchedule extends Model
{
    protected $primaryKey = 'schedule_id';

    /**
     * Delivery Locations that belong to the Schedule.
     */
    public function locations()
    {
        return $this->belongsToMany('App\Models\DeliveryLocation', 'location_schedules', 'schedule_id', 'location_id');
    }

}
