<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductBrand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandsController extends Controller
{
    public function __construct() {
        $this->middleware(['admin', 'checkSA', 'auth:admin']);
        $this->middleware('can:view-brand');
        $this->middleware('can:create-brand')->only(['create']);
        $this->middleware('can:edit-brand')->only(['edit']);
    }

    public function index() {
        $brands = ProductBrand::all()
            ->sortBy(function($brand) {
                return $brand->pb_name;
            });

        return view('admin.product-brands.index')
            ->with([
                'brands'    => $brands
            ]);
    }

    public function create() {
        return view('admin.product-brands.create');
    }

    public function edit($id) {
        $brand = ProductBrand::find($id);

        if(!$brand) {
            abort(404);
        }
        return view('admin.product-brands.edit')
            ->with('brand_id', $brand->pb_id);
    }

    public function show($id) {
        $brand = ProductBrand::find($id);
        if(!$brand) {
            return view('admin.product-brands.single')
                ->with('notFound', 'Requested Brand not found..!!!');
        }
        return view('admin.product-brands.single')
            ->with('brand', $brand);
    }


}
