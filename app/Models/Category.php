<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Category extends Model
{

    protected $primaryKey  = 'category_id';


    public function products() {
        return $this->belongsToMany('App\Models\Product', 'product_categories', 'pc_category_id', 'pc_product_id');
    }

    public function isParent() {
        return $this->category_type === 'parent';
    }

    public function isChild() {
        return $this->category_type === 'child';
    }

    public function isFiltering() {
        return $this->category_type === 'filtering';
    }

    public function parent() {
        return $this->newQuery()
            ->where('category_id', '=', $this->category_parent_id)
            ->first();
    }
}
