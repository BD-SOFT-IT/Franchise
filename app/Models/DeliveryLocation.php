<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;


class DeliveryLocation extends Model
{
    protected $primaryKey = 'location_id';

    /**
     * get the creator of the location
     */
    public function author() {
        return $this->belongsTo('App\Models\Admin', 'location_admin_id', 'id');
    }

    /**
     * Delivery Schedules that belong to the Location.
     */
    public function schedules()
    {
        return $this->belongsToMany('App\Models\DeliverySchedule', 'location_schedules', 'location_id', 'schedule_id');
    }


    public function locationCity() {
        $city = $this->newQuery()->where('location_id', '=', $this->location_parent)
            ->where('location_type', '=', 'city')
            ->first();
        return $city;
    }

    public function locationState() {
        if($this->location_type == 'city') {
            $state = $this->newQuery()->where('location_id', '=', $this->location_parent)
                ->where('location_type', '=', 'state')
                ->first();
        }
        else {
            $state = ($this->locationCity()) ? $this->locationCity()->locationState() : null;
        }
        return $state;
    }

    public function locationCountry() {
        if($this->location_type == 'state') {
            $country = $this->newQuery()->where('location_id', '=', $this->location_parent)
                ->where('location_type', '=', 'country')
                ->first();
        }
        else if($this->location_type == 'city') {
            $country = ($this->locationState()) ? $this->locationState()->locationCountry() : null;
        }
        else {
            $country = ($this->locationCity() && $this->locationState()) ? $this->locationCity()->locationState()->locationCountry() : null;
        }
        return $country;
    }

    public function getLog() {
        return convertStringToArray($this->location_log, true);
    }
}
