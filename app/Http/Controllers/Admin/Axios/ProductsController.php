<?php

namespace App\Http\Controllers\Admin\Axios;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use Carbon\Carbon;


class ProductsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware(['checkSA', 'admin', 'auth:admin']);

        $this->middleware('can:create-product')->only('store');
        $this->middleware('can:view-product-details')->only('getSingle');
        $this->middleware('can:view-product')->only('getAll');
        $this->middleware('can:delete-product')->only('delete');
        $this->middleware('can:update-product')->only(['updateGeneral', 'updateOptions', 'updateVendor', 'updateMeta', 'updateAppData', 'updateImages']);
    }

    public function getAll(Request $request) {
        $per_page = ($request->get('per_page'))? $request->get('per_page') : 15;
        $search = htmlspecialchars($request->get('search'));

        $products = Product::where('product_sku', 'LIKE', "%$search%")
            ->orWhere('product_title', 'LIKE', "%$search%")
            ->orWhere('product_title_bengali', 'LIKE', "%$search%")
            ->orderByDesc('created_at')
            ->select([
                'products.product_id', 'products.product_sku', 'products.product_title', 'products.product_availability_status', 'products.product_units_in_stock',
                'products.product_unit_mrp', 'products.product_unit_cost', 'products.product_unit_mrp_franchise', 'products.product_img_main',
                'products.product_available_colors', 'products.product_available_sizes', 'products.product_units_min_franchise', 'products.product_units_in_stock'
            ])
            ->paginate($per_page);

        $categories = [];
        foreach($products as $product) {
            $cat = new \stdClass();
            $cat->product_id = $product->product_id;
            $cat->category_title = $this->categoriesStringForSingle($product->product_id);
            array_push($categories, $cat);
        }

        return response()->json([
            'products'   => $products,
            'categories' => $categories
        ], 200);
    }

    public function franchiseProducts(Request $request) {
        $per_page = ($request->get('per_page'))? $request->get('per_page') : 15;
        $search = htmlspecialchars($request->get('search'));

        $products = auth('admin')->user()->franchiseProducts()
            ->where('product_sku', 'LIKE', "%$search%")
            ->orWhere('product_title', 'LIKE', "%$search%")
            ->orderByDesc('created_at')
            ->select([
                'products.product_id', 'products.product_sku', 'products.product_title', 'products.product_availability_status', 'products.product_units_in_stock',
                'products.product_title_bengali', 'products.product_unit_mrp', 'products.product_unit_cost', 'products.product_unit_mrp_franchise', 'products.product_img_main'
            ])
            ->paginate($per_page);

        $categories = [];
        foreach($products as $product) {
            $cat = new \stdClass();
            $cat->product_id = $product->product_id;
            $cat->category_title = $this->categoriesStringForSingle($product->product_id);
            array_push($categories, $cat);
        }

        return response()->json([
            'products'   => $products,
            'categories' => $categories
        ], 200);
    }

    public function getSingle($id) {
        $product = Product::find($id);

        if(!$product) {
            sendNotFoundJsonResponse('Product not found..!!!');
        }

        $general = [
            'product_sku'                   => $product->product_sku,
            'product_title'                 => $product->product_title,
            'product_title_bengali'         => $product->product_title_bengali,
            'product_description'           => $product->product_description,
            'product_description_bengali'   => $product->product_description_bengali,
            'product_categories'            => $product->categories->getQueueableIds(),
            'product_unit_name'             => $product->product_unit_name,
            'product_unit_quantity'         => $product->product_unit_quantity,
            'product_unit_cost'             => $product->product_unit_cost,
            'product_unit_mrp'              => $product->product_unit_mrp,
            'product_unit_mrp_franchise'    => $product->product_unit_mrp_franchise,
            'product_units_in_stock'        => $product->product_units_in_stock,
            'product_availability_status'   => $product->product_availability_status,
            'product_replacement_available' => ($product->product_replacement_available) ? true : false,
            'product_guarantee_time'        => $product->product_guarantee_time,
            'product_guarantee_status'      => $product->product_guarantee_status,
            'product_active'                => ($product->product_active) ? true : false,
            'product_available_outside'     => ($product->product_available_outside) ? true : false,
            'product_unit_subtract_on_order'=> ($product->product_unit_subtract_on_order) ? true : false,
            'product_units_max_selection'   => $product->product_units_max_selection,
            'product_units_min_franchise'   => $product->product_units_min_franchise,
        ];
        $meta = [
            'product_description_short'     => $product->product_description_short,
            'product_keywords'              => $product->product_keywords
        ];
        $app = [
            'product_description_app'           => $product->product_description_app,
            'product_description_bengali_app'   => $product->product_description_bengali_app
        ];
        $vendor = [
            'product_vendor'                => ($product->product_vendor) ? $product->product_vendor : '',
            'product_vendor_sku'            => $product->product_vendor_sku
        ];
        $options = [
            'product_available_sizes'       => $product->product_available_sizes,
            'product_available_colors'      => $product->product_available_colors,
            'product_featured'              => ($product->product_featured) ? true : false,
            'product_offered'               => ($product->product_offered) ? true : false,
            'product_discounted'            => ($product->product_discounted) ? true : false,
            'product_discount_amount'       => $product->product_discount_amount,
            'product_discount_percentage'   => $product->product_discount_percentage
        ];
        $images = [
            'product_img_main'              => $product->product_img_main,
            'product_img_2'                 => $product->product_img_2,
            'product_img_3'                 => $product->product_img_3,
            'product_img_4'                 => $product->product_img_4,
            'product_img_5'                 => $product->product_img_5
        ];

        return response()
            ->json([
                'general'   => $general,
                'options'   => $options,
                'meta'      => $meta,
                'app'       => $app,
                'vendor'    => $vendor,
                'images'    => $images,
                'categories'=> $this->categoriesForSingleProduct($product)
            ], 200);
    }

    public function store(Request $request) {
        $request->validate([
            'product_sku'                   => 'required|alpha_num|min:10|max:15|unique:products',
            'product_title'                 => 'required|max:70|string',
            'product_title_bengali'         => 'nullable|string|max:70', /* regex:/^[\p{Bengali} ]{0,100}$/u */
            'product_description'           => 'required|string|min:100',
            'product_description_bengali'   => 'string|nullable',
            'product_categories'            => 'array|required',
            'product_unit_name'             => 'required|string',
            'product_unit_quantity'         => 'required|numeric',
            'product_unit_cost'             => 'required|numeric',
            'product_unit_mrp'              => 'required|numeric',
            'product_unit_mrp_franchise'    => 'nullable|numeric',
            'product_units_in_stock'        => 'required|numeric',
            'product_availability_status'   => 'required|string',
            'product_replacement_available' => 'required|boolean',
            'product_guarantee_time'        => 'string|nullable',
            'product_guarantee_status'      => 'required|string',
            'product_active'                => 'required|boolean',
            'product_available_outside'     => 'required|boolean',
            'product_unit_subtract_on_order'=> 'required|boolean',
            'product_units_max_selection'   => 'required|numeric',
            'product_units_min_franchise'   => 'required|numeric'
        ]);

        $slug = createSlug(Product::class, 'product_slug', $request->post('product_title'), $request->post('product_title_bengali'));

        $product = new Product;

        $product->product_sku = $request->post('product_sku');
        $product->product_title = $request->post('product_title');
        $product->product_title_bengali = $request->post('product_title_bengali');
        $product->product_slug = $slug;
        $product->product_description = Purifier::clean($request->post('product_description'));
        $product->product_description_bengali = Purifier::clean($request->post('product_description_bengali'));
        $product->product_categories = convertArrayToString($request->post('product_categories'));
        $product->product_unit_name = $request->post('product_unit_name');
        $product->product_unit_quantity = $request->post('product_unit_quantity');
        $product->product_unit_cost = $request->post('product_unit_cost');
        $product->product_unit_mrp = $request->post('product_unit_mrp');
        $product->product_unit_mrp_franchise = $request->post('product_unit_mrp_franchise');
        $product->product_units_in_stock = $request->post('product_units_in_stock');
        $product->product_availability_status = $request->post('product_availability_status');
        $product->product_availability_status = $request->post('product_availability_status');
        $product->product_replacement_available = $request->post('product_replacement_available');
        $product->product_guarantee_time = $request->post('product_guarantee_time');
        $product->product_guarantee_status = $request->post('product_guarantee_status');
        $product->product_active = $request->post('product_active');
        $product->product_available_outside = $request->post('product_available_outside');
        $product->product_unit_subtract_on_order = $request->post('product_unit_subtract_on_order');
        $product->product_units_max_selection = $request->post('product_units_max_selection');
        $product->product_units_min_franchise = $request->post('product_units_min_franchise');

        $new_log = [
            'type'          => 'created',
            'author_id'     => auth('admin')->id(),
            'author_name'   => auth('admin')->user()->name,
            'old_cost'      => 'null',
            'new_cost'      => $request->post('product_unit_cost'),
            'old_mrp'       => 'null',
            'new_mrp'       => $request->post('product_unit_mrp'),
            'old_stock'     => 'null',
            'new_stock'     => 'null',
            'time'          => Carbon::now()
        ];
        $product->product_logs = makeNewLog($new_log, null, true);

        if(!$product->save()) {
            sendServerErrorJsonResponse();
        }

        $product->categories()->attach($request->post('product_categories'));
        return response()
            ->json([
                'product_id' => $product->product_id
            ], 200);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function updateGeneral(Request $request, $id) {
        $product = Product::find($id);
        if(!$product) {
            sendNotFoundJsonResponse('Product Not Found..!!!');
        }
        $request->validate([
            'product_sku'                   => 'required|alpha_num|min:10|max:15',
            'product_title'                 => 'required|max:70|string',
            'product_title_bengali'         => 'nullable|string|max:70', /* regex:/^[\p{Bengali} ]{0,100}$/u */
            'product_description'           => 'required|string|min:100',
            'product_description_bengali'   => 'string|nullable',
            'product_categories'            => 'array|required',
            'product_unit_name'             => 'required|string',
            'product_unit_quantity'         => 'required|numeric',
            'product_unit_cost'             => 'required|numeric',
            'product_unit_mrp'              => 'required|numeric',
            'product_unit_mrp_franchise'    => 'nullable|numeric',
            'product_availability_status'   => 'required|string',
            'product_units_in_stock'        => 'required|numeric',
            'product_replacement_available' => 'required|boolean',
            'product_guarantee_time'        => 'string|nullable',
            'product_guarantee_status'      => 'required|string',
            'product_active'                => 'required|boolean',
            'product_available_outside'     => 'required|boolean',
            'product_unit_subtract_on_order'=> 'required|boolean',
            'product_units_max_selection'   => 'required|numeric',
            'product_units_min_franchise'   => 'required|numeric'
        ]);
        if($product->product_sku != $request->post('product_sku')) {
            $request->validate([
                'product_sku' => 'unique:products',
            ]);
            $product->product_sku = $request->post('product_sku');
        }

        if($product->product_title != $request->post('product_title') || $product->product_title_bengali != $request->post('product_title_bengali')) {
            $slug = createSlug(Product::class, 'product_slug', $request->post('product_title'), $request->post('product_title_bengali'));
            $product->product_slug = $slug;
        }

        $product->product_title = $request->post('product_title');
        $product->product_title_bengali = $request->post('product_title_bengali');
        $product->product_description = Purifier::clean($request->post('product_description'));
        $product->product_description_bengali = Purifier::clean($request->post('product_description_bengali'));
        $product->product_unit_name = $request->post('product_unit_name');
        $product->product_unit_quantity = $request->post('product_unit_quantity');
        $product->product_unit_cost = $request->post('product_unit_cost');
        $product->product_unit_mrp = $request->post('product_unit_mrp');
        $product->product_unit_mrp_franchise = $request->post('product_unit_mrp_franchise');
        $product->product_units_in_stock = $request->post('product_units_in_stock');
        $product->product_availability_status = $request->post('product_availability_status');
        $product->product_replacement_available = $request->post('product_replacement_available');
        $product->product_guarantee_time = $request->post('product_guarantee_time');
        $product->product_guarantee_status = $request->post('product_guarantee_status');
        $product->product_active = $request->post('product_active');
        $product->product_available_outside = $request->post('product_available_outside');
        $product->product_unit_subtract_on_order = $request->post('product_unit_subtract_on_order');
        $product->product_units_max_selection = $request->post('product_units_max_selection');
        $product->product_units_min_franchise = $request->post('product_units_min_franchise');

        $product->categories()->sync($request->post('product_categories'));

        $new_log = [
            'type'          => 'general data updated',
            'author_id'     => auth('admin')->id(),
            'author_name'   => auth('admin')->user()->name,
            'old_cost'      => $product->product_unit_cost,
            'new_cost'      => 'null',
            'old_mrp'       => $product->product_unit_mrp,
            'new_mrp'       => 'null',
            'old_stock'     => $product->product_units_in_stock,
            'new_stock'     => 'null',
            'time'          => Carbon::now()
        ];
        if($product->product_unit_cost != $request->post('product_unit_cost')) {
            $new_log['new_cost'] = $request->post('product_unit_cost');
        }
        if($product->product_unit_mrp != $request->post('product_unit_mrp')) {
            $new_log['new_mrp'] = $request->post('product_unit_mrp');
        }
        $product->product_logs = makeNewLog($new_log, $product->product_logs, true);

        if(!$product->save()) {
            sendServerErrorJsonResponse();
        }
        return response()
            ->json('updated', 200);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOptions(Request $request, $id) {
        $product = Product::find($id);
        if(!$product) {
            sendNotFoundJsonResponse('Product Not Found..!!!');
        }
        $request->validate([
            'product_available_sizes'       => 'nullable|array',
            'product_available_colors'      => 'nullable|array',
            'product_featured'              => 'required|boolean',
            'product_offered'               => 'required|boolean',
            'product_discounted'            => 'required|boolean',
            'product_discount_amount'       => 'numeric|nullable',
            'product_discount_percentage'   => 'numeric|nullable|max:100',
        ]);

        $product->product_available_sizes = (is_array($request->post('product_available_sizes'))) ? convertArrayToString($request->post('product_available_sizes')) : null;
        $product->product_available_colors = (is_array($request->post('product_available_colors'))) ? convertArrayToString($request->post('product_available_colors')) : null;
        $product->product_featured = $request->post('product_featured');
        $product->product_offered = $request->post('product_offered');
        $product->product_discounted = $request->post('product_discounted');
        $product->product_discount_amount = $request->post('product_discount_amount');
        $product->product_discount_percentage = $request->post('product_discount_percentage');

        $new_log = [
            'type'          => 'options data updated',
            'author_id'     => auth('admin')->id(),
            'author_name'   => auth('admin')->user()->name,
            'old_cost'      => 'null',
            'new_cost'      => 'null',
            'old_mrp'       => 'null',
            'new_mrp'       => 'null',
            'old_stock'     => 'null',
            'new_stock'     => 'null',
            'time'          => Carbon::now()
        ];
        $product->product_logs = makeNewLog($new_log, $product->product_logs, true);

        if(!$product->save()) {
            sendServerErrorJsonResponse();
        }
        return response()
            ->json('updated', 200);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateVendor(Request $request, $id) {
        $product = Product::find($id);
        if(!$product) {
            sendNotFoundJsonResponse('Product Not Found..!!!');
        }
        $request->validate([
            'product_vendor'                => 'numeric|nullable',
            'product_vendor_sku'            => 'max:30|string|nullable',
        ]);

        $product->product_vendor = $request->post('product_vendor');
        $product->product_vendor_sku = $request->post('product_vendor_sku');

        $new_log = [
            'type'          => 'vendor data updated',
            'author_id'     => auth('admin')->id(),
            'author_name'   => auth('admin')->user()->name,
            'old_cost'      => 'null',
            'new_cost'      => 'null',
            'old_mrp'       => 'null',
            'new_mrp'       => 'null',
            'old_stock'     => 'null',
            'new_stock'     => 'null',
            'time'          => Carbon::now()
        ];
        $product->product_logs = makeNewLog($new_log, $product->product_logs, true);

        if(!$product->save()) {
            sendServerErrorJsonResponse();
        }
        return response()
            ->json('updated', 200);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateMeta(Request $request, $id) {
        $product = Product::find($id);
        if(!$product) {
            sendNotFoundJsonResponse('Product Not Found..!!!');
        }

        $request->validate([
            'product_description_short'     => 'nullable|string|max:350|min:50',
            'product_keywords'              => 'nullable|string|max:110',
        ]);

        $product->product_description_short = $request->post('product_description_short');
        $product->product_keywords = $request->post('product_keywords');

        $new_log = [
            'type'          => 'meta data updated',
            'author_id'     => auth('admin')->id(),
            'author_name'   => auth('admin')->user()->name,
            'old_cost'      => 'null',
            'new_cost'      => 'null',
            'old_mrp'       => 'null',
            'new_mrp'       => 'null',
            'old_stock'     => 'null',
            'new_stock'     => 'null',
            'time'          => Carbon::now()
        ];
        $product->product_logs = makeNewLog($new_log, $product->product_logs, true);

        if(!$product->save()) {
            sendServerErrorJsonResponse();
        }
        return response()
            ->json('updated', 200);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAppData(Request $request, $id) {
        $product = Product::find($id);
        if(!$product) {
            sendNotFoundJsonResponse('Product Not Found..!!!');
        }

        $request->validate([
            'product_description_app'           => 'nullable|string|max:1024|min:50',
            'product_description_bengali_app'   => 'nullable|string|max:1024|min:50',
        ]);

        $product->product_description_app = $request->post('product_description_app');
        $product->product_description_bengali_app = $request->post('product_description_bengali_app');

        $new_log = [
            'type'          => 'app data updated',
            'author_id'     => auth('admin')->id(),
            'author_name'   => auth('admin')->user()->name,
            'old_cost'      => 'null',
            'new_cost'      => 'null',
            'old_mrp'       => 'null',
            'new_mrp'       => 'null',
            'old_stock'     => 'null',
            'new_stock'     => 'null',
            'time'          => Carbon::now()
        ];
        $product->product_logs = makeNewLog($new_log, $product->product_logs, true);

        if(!$product->save()) {
            sendServerErrorJsonResponse();
        }
        return response()
            ->json('updated', 200);
    }

    public function delete($id) {
        $product = Product::find($id);
        if(!$product) {
            sendNotFoundJsonResponse('Not Found..!');
        }
        if(!$product->delete()) {
            sendServerErrorJsonResponse();
        }
        return response()->json('Deleted', 200);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateImages(Request $request, $id) {
        $product = Product::find($id);
        if(!$product) {
            sendNotFoundJsonResponse('Product Not Found..!!!');
        }
        $request->validate([
            'product_img_main'              => 'string|nullable|max:1024',
            'product_img_2'                 => 'string|nullable|max:1024',
            'product_img_3'                 => 'string|nullable|max:1024',
            'product_img_4'                 => 'string|nullable|max:1024',
            'product_img_5'                 => 'string|nullable|max:1024'
        ]);

        $product->product_img_main = $request->post('product_img_main');
        $product->product_img_2 = $request->post('product_img_2');
        $product->product_img_3 = $request->post('product_img_3');
        $product->product_img_4 = $request->post('product_img_4');
        $product->product_img_5 = $request->post('product_img_5');

        $new_log = [
            'type'          => 'image data updated',
            'author_id'     => auth('admin')->id(),
            'author_name'   => auth('admin')->user()->name,
            'old_cost'      => 'null',
            'new_cost'      => 'null',
            'old_mrp'       => 'null',
            'new_mrp'       => 'null',
            'old_stock'     => 'null',
            'new_stock'     => 'null',
            'time'          => Carbon::now()
        ];
        $product->product_logs = makeNewLog($new_log, $product->product_logs, true);

        if(!$product->save()) {
            sendServerErrorJsonResponse();
        }
        return response()
            ->json('updated', 200);
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

}
