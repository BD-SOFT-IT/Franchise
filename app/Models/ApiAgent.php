<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ApiAgent extends Model
{
    protected $primaryKey = 'agent_id';

    public function clients() {
        return $this->hasMany('App\Models\Client', 'app_api_agent');
    }
}
