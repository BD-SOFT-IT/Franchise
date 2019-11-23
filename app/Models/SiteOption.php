<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class SiteOption extends Model
{
    protected $primaryKey = 'so_id';

    protected $fillable = ['so_modifier_id', 'so_name', 'so_content'];
}
