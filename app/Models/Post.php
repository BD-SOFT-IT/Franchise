<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $primaryKey = 'post_id';

    public function author() {
        return $this->belongsTo(Admin::class, 'post_admin_id', 'id');
    }
}
