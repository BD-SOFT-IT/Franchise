<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware(['admin', 'checkSA', 'auth:admin']);
    }


    public function index() {
        $this->authorize('view-product', Product::class);

        return view('admin.products.all')
            ->with([
                'summary'   => $this->getProductSummary()
            ]);
    }

    public function returned() {
        $this->authorize('view-product', Product::class);

        return view('admin.products.returned')
            ->with([
                'summary'   => $this->getProductSummary()
            ]);
    }

    public function damaged() {
        $this->authorize('view-product', Product::class);

        return view('admin.products.damaged')
            ->with([
                'summary'   => $this->getProductSummary()
            ]);
    }

    public function franchise() {
        if(!auth('admin')->user()->isFranchise()) {
            return redirect()->back(403);
        }

        return view('admin.products.franchise');
    }

    public function show($sku) {
        $this->authorize('view-product-details', Product::class);

        $product = Product::where('product_sku', '=', $sku)
            ->first();
        if(!$product) {
            return view('admin.products.single')
                ->with([
                    'summary'   => $this->getProductSummary(),
                    'notFound'  => 'Requested Product not found..!!!'
                ]);
        }

        return view('admin.products.single')
            ->with([
                'summary'   => $this->getProductSummary(),
                'product'  => $product,
                'categories' => $this->categoriesStringForSingle($product->product_id)
            ]);
    }

    public function create() {
        $this->authorize('create-product', Product::class);

        return view('admin.products.create')
            ->with([
                'summary'   => $this->getProductSummary()
            ]);
    }

    public function edit($id) {
        $this->authorize('update-product', Product::class);

        if($id == null) {
            abort(404);
        }
        $product = Product::find($id);
        if(!$product) {
            return redirect()->back();
        }
        return view('admin.products.create')
            ->with([
                'product' => $product,
                'summary'   => $this->getProductSummary()
            ]);
    }

    /**
     * @return \stdClass
     */
    public function getProductSummary() {
        $summary = new \stdClass();

        $summary->out_of_stock = Product::where('product_active', '=', 1)
            ->where('product_availability_status', '=', 'Out of Stock')
            ->count();
        $summary->featured = Product::where('product_active', '=', 1)
            ->where('product_featured', '=', 1)
            ->count();
        $summary->inactive = Product::where('product_active', '=', 0)
            ->count();
        $summary->total = Product::count();

        return $summary;
    }

    protected function categoriesStringForSingle($id) {
        $product = Product::find($id);
        $categories = '';
        $count = 1;
        foreach($this->categoriesForSingleProduct($product) as $category) {
            $categories .= $category['category_title'];
            if($count < count($this->categoriesForSingleProduct($product))) {
                $categories .= ', ';
            }
            $count++;
        }
        return $categories;
    }

    protected function categoriesForSingleProduct(Product $product) {
        $categories = [];
        foreach($product->categories as $category) {
            $cat = [];
            $cat['category_id'] = $category->category_id;
            $cat['category_title'] = $category->category_title;
            $cat['category_parent_id'] = $category->category_parent_id;
            $cat['category_type'] = $category->category_type;
            array_push($categories, $cat);
        }
        return $categories;
    }

}
