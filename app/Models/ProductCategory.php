<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ProductCategory extends Model
{
    /**
     * The table primary key.
     */
    protected $primaryKey  = 'pc_id';

    /**
     * Get the category for the relation
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'pc_category_id');
    }

    /**
     * Get the product for the relation
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'pc_product_id');
    }
}
