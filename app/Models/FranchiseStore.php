<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FranchiseStore extends Model
{
    protected $primaryKey = 'fs_id';

    public function setFsColorsAttribute($value) {
        return ($value !== null && count($value) > 0) ? convertArrayToString($value) : null;
    }

    public function setFsSizesAttribute($value) {
        return ($value !== null && count($value) > 0) ? convertArrayToString($value) : null;
    }

    public function getFsColorsAttribute($value) {
        return ($value !== null && strlen($value) > 5) ? convertStringToArray($value) : null;
    }

    public function getFsSizesAttribute($value) {
        return ($value !== null && strlen($value) > 5) ? convertStringToArray($value) : null;
    }

    public function user() {
        return $this->belongsTo(Admin::class, 'fs_admin_id', 'id')->withDefault();
    }

    public function product() {
        return $this->belongsTo(Product::class, 'fs_product_id', 'product_id')->withDefault();
    }
}
