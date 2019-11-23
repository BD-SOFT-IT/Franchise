<?php

namespace Theme\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Str;

class ProductsController extends Controller
{
    public function shop(Request $request, $slug = null) {
        $breadcrumb = [
            'data'  => [ ],
            'active'   => ''
        ];
        $category = null;
        if($slug) {
            $category = Category::whereCategoryActive(1)
                ->where('category_slug', '=', $slug)
                ->first();

            if(!$category || !$category->products || count($category->products) <= 0) {
                $breadcrumb['active'] = 'Not Found';
                return view('theme::shop')->with([
                    'error'         => 'Not Found',
                    'title'         => 'Not Found',
                    'description'   => 'Not Found',
                    'breadcrumb'    => $breadcrumb
                ]);
            }

            $products = $category->products()->where('product_active', '=', 1);
            $title = $category->category_title;
            $description = Str::limit($category->category_description, 180);

            array_push($breadcrumb['data'], ['url' => route('shop'), 'title' => 'Shop']);
            if($category->isFiltering()) {
                $child = $category->parent();
                $parent = $child->parent();
                $url = ['url' => route('category.single', ['slug' => $parent->category_slug]), 'title' => $parent->category_title];
                array_push($breadcrumb['data'], $url);
                $url = ['url' => route('category.single', ['slug' => $child->category_slug]), 'title' => $child->category_title];
                array_push($breadcrumb['data'], $url);
                $breadcrumb['active'] = $category->category_title;
            }
            else if($category->isChild()) {
                $parent = $category->parent();
                $url = ['url' => route('category.single', ['slug' => $parent->category_slug]), 'title' => $parent->category_title];
                array_push($breadcrumb['data'], $url);
                $breadcrumb['active'] = $category->category_title;
            }
            else {
                $breadcrumb['active'] = $category->category_title;
            }
        }
        else {
            $products = Product::whereProductActive(1);
            $title = 'Shop';
            $description = 'See & Filter all products';
            $breadcrumb['active'] = 'Shop';
        }

        //dd($products->max('product_unit_mrp'));
        $minPrice = $request->get('minP') ? $request->get('minP') : ($products->min('product_unit_mrp') ? $products->min('product_unit_mrp') : 0);
        $maxPrice = $request->get('maxP') ? $request->get('maxP') : ($products->max('product_unit_mrp') ? $products->max('product_unit_mrp') : 10000);
        $perPage = $request->get('perPage') ? $request->get('perPage') : 12;
        $page = $request->get('page') ?: (Paginator::resolveCurrentPage() ?: 1);
        $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'asc';
        $size = $request->get('size') ? $request->get('size') : null;
        $color = $request->get('color') ? $request->get('color') : null;
        $brand = $request->get('brand') ? $request->get('brand') : null;

        $products = $products->where('product_unit_mrp', '>=', $minPrice)
            ->where('product_unit_mrp', '<=', $maxPrice);

        if($sortBy == 'latest') {
            $products = $products->orderByDesc('updated_at')->get();
        }
        else if($sortBy == 'oldest') {
            $products = $products->orderBy('updated_at')->get();
        }
        else if($sortBy == 'high') {
            $products = $products->orderByDesc('product_unit_mrp')->get();
        }
        else if($sortBy == 'low') {
            $products = $products->orderBy('product_unit_mrp')->get();
        }
        else if($sortBy == 'asc') {
            $products = $products->orderBy('product_title')->get();
        }
        else {
            $products = $products->orderByDesc('product_title')->get();
        }

        if($brand) {
            $vendor = ProductBrand::where('pb_name', '=', $brand)->first();
            if($vendor) {
                $products = $products->filter(function($product) use ($vendor) {
                    return $vendor->pb_id === $product->product_vendor;
                });
                $page = 1;
            }
        }

        if($color) {
            $products = $products->filter(function($product) use ($color) {
                return ($product->product_available_colors != null && in_array($color, $product->product_available_colors));
            });
            $page = 1;
        }

        if($size) {
            $products = $products->filter(function($product) use ($size) {
                return ($product->product_available_sizes != null && in_array($size, $product->product_available_sizes));
            });
            $page = 1;
        }

        $paginatedProducts = new LengthAwarePaginator($products->forPage($page, $perPage), $products->count(), $perPage, $page);

        return view('theme::shop')->with([
            'title'         => $title,
            'description'   => $description,
            'breadcrumb'    => $breadcrumb,
            'products'      => $paginatedProducts,
            'brands'        => $this->brands($products),
            'colors'        => $this->colors($products),
            'sizes'         => $this->sizes($products),
            'minPrice'      => $minPrice,
            'maxPrice'      => $maxPrice,
            'category'      => $category
        ]);

    }

    public function show($slug) {
        $product = getProductBySlug($slug);
        if(!$product) {
            return view('theme::product-details')
                ->with([
                    'error'         => 'Requested Product Not Found',
                    'title'         => 'Not Found',
                    'description'   => 'Not Found',
                    'keywords'      => 'Not Found'
                ]);
        }

        return view('theme::product-details')
            ->with([
                'product'       => $product,
                'title'         => $product->product_title,
                'description'   => $product->product_description,
                'keywords'      => $product->product_keywords
            ]);
    }

    /**
     * @param Collection $products
     * @return Collection
     */
    protected function brands(Collection $products) {
        $brands = collect();
        foreach ($products as $product) {
            $brand = $product->brand;
            if($brand) {
                $brands->push($brand);
            }
        }
        return $brands->unique('pb_id');
    }

    /**
     * @param Collection $products
     * @return array|null
     */
    protected function colors(Collection $products) {
        $colors = [];
        foreach ($products as $product) {
            if ($product->product_available_colors) {
                foreach ($product->product_available_colors as $color) {
                    array_push($colors, $color);
                }
            }
        }
        return array_unique($colors, SORT_STRING);
    }

    /**
     * @param Collection $products
     * @return array|null
     */
    protected function sizes(Collection $products) {
        $sizes = [];
        foreach ($products as $product) {
            if ($product->product_available_sizes) {
                foreach ($product->product_available_sizes as $size) {
                    array_push($sizes, $size);
                }
            }
        }
        return array_unique($sizes, SORT_STRING);
    }
}
