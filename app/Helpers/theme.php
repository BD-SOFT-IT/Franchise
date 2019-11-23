<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use function foo\func;

/**
 * @param string $type
 * @param int|null $parent
 * @param int $count
 * @return Category[]|Builder[]|Collection|null
 */
function getCategories(string $type = 'parent', int $parent = null, int $count = 10) {
    if($type !== 'parent' && $type !== 'child' && $type !== 'filtering') {
        return null;
    }

    return Category::whereCategoryType($type)
        ->where('category_active', '=', 1)
        ->where('category_parent_id', '=', $parent)
        ->orderBy('category_order')
        ->take($count)
        ->get();
}

/**
 * @param string $type
 * @param int|null $count
 * @return Product[]|Builder[]|Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection|null
 */
function productsByType(string $type = 'all', int $count = null) {
    if(!in_array(strtolower($type), ['all', 'discounted', 'offered', 'featured', 'new'])) {
        return null;
    }
    $products = null;
    switch ($type) {
        case 'all':
            $products = Product::whereProductActive(true)
                ->orderByDesc('updated_at')
                ->get();
            break;
        case 'discounted':
            $products = Product::whereProductActive(true)
                ->where('product_discounted', '=', true)
                ->orderByDesc('updated_at')
                ->get();
            break;
        case 'offered':
            $products = Product::whereProductActive(true)
                ->where('product_offered', '=', true)
                ->orderByDesc('updated_at')
                ->get();
            break;
        case 'featured':
            $products = Product::whereProductActive(true)
                ->where('product_featured', '=', true)
                ->orderByDesc('updated_at')
                ->get();
            break;
        case 'new':
            $products = Product::whereProductActive(true)
                ->whereDate('created_at', '>', Carbon::now()->subDays(60))
                ->orderByDesc('updated_at')
                ->get();
            break;
    }
    return ($count && $count > 0) ? $products->take($count) : $products;
}

/**
 * @param string $slug
 * @return Product|Builder|Model
 */
function getProductBySlug(string $slug) {
    return Product::whereProductSlug($slug)->first();
}

/**
 * @param string $slug
 * @return Post|Builder|Model
 */
function getPage(string $slug) {
    return Post::wherePostSlug($slug)->first();
}

/**
 * @param Product $product
 * @return array
 */
function getFranchises(Product $product) {
    $franchises = [];
    if(!$product || !$product->franchises || count($product->franchises) <= 0) {
        return $franchises;
    }
    foreach ($product->franchises as $franchise) {
        $item = new stdClass();
        $item->name = $franchise->name;
        $item->id = $franchise->franchise_id;
        array_push($franchises, $item);
    }
    return $franchises;
}
