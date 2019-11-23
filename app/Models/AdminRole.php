<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    protected $primaryKey = 'ar_id';

    public function admins() {
        return $this->hasMany(Admin::class, 'role_id', 'ar_id');
    }
}
