<?php

namespace App\Http\Controllers\Admin\Axios;

use App\Models\ProductBrand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandsController extends Controller
{
    public function __construct() {
        $this->middleware(['admin', 'checkSA', 'auth:admin']);
        $this->middleware('can:view-brand');
        $this->middleware('can:create-brand')->only(['store']);
    }


    public function store(Request $request) {
        $request->validate([
            'pb_name'           => 'required|string|max:25|min:2|unique:product_brands',
            'pb_name_bengali'   => 'nullable|string|max:30|min:2',
            'pb_website'        => 'nullable|string|max:150|min:6',
            'pb_phone'          => 'nullable|string|max:15',
            'pb_email'          =>  'nullable|email|max:55',
            'pb_img'            =>  'nullable|string|max:191',
        ]);

        $log = makeNewLog([
            'type'          => 'Brand Created',
            'author_id'     => auth('admin')->id(),
            'author_name'   => auth('admin')->user()->name,
            'time'          => \Carbon\Carbon::now()
        ], null, true);

        $brand = new ProductBrand;

        $brand->pb_name = $request->post('pb_name');
        $brand->pb_name_bengali = $request->post('pb_name_bengali');
        $brand->pb_img = $request->post('pb_img');
        $brand->pb_website = $request->post('pb_website');
        $brand->pb_phone = $request->post('pb_phone');
        $brand->pb_email = $request->post('pb_email');
        $brand->pb_log = $log;

        if(!$brand->save()) {
            sendServerErrorJsonResponse();
        }

        return response()->json($brand->pb_id, 200);
    }

    public function single($id) {
        $brand = ProductBrand::where('pb_id', '=', $id)
            ->select([
                'product_brands.pb_id', 'product_brands.pb_name', 'product_brands.pb_name_bengali', 'product_brands.pb_website',
                'product_brands.pb_phone', 'product_brands.pb_email', 'product_brands.pb_img'
                ])
            ->first();
        if(!$brand) {
            sendNotFoundJsonResponse('Brand not found..!');
        }

        return response()->json($brand, 200);
    }

    public function brandSelectionData() {
        $brands = ProductBrand::select(['product_brands.pb_id', 'product_brands.pb_name'])
            ->orderBy('pb_name')
            ->get();

        return response()->json($brands, 200);
    }

    public function getAll(Request $request) {
        $per_page = ($request->get('per_page'))? $request->get('per_page') : 15;
        $search = htmlspecialchars($request->get('search'));

        $brands = ProductBrand::where('pb_name', 'LIKE', "%$search%")
            ->orWhere('pb_name_bengali', 'LIKE', "%$search%")
            ->orderByDesc('pb_name')
            ->paginate($per_page);

        return response()->json($brands, 200);
    }

    public function update(Request $request, $id) {
        $brand = ProductBrand::find($id);
        if(!$brand) {
            sendNotFoundJsonResponse('Brand not found');
        }
        $request->validate([
            'pb_name_bengali'   => 'nullable|string|max:30|min:2',
            'pb_website'        => 'nullable|string|max:150|min:6',
            'pb_phone'          => 'nullable|string|max:15',
            'pb_email'          =>  'nullable|email|max:55',
            'pb_img'            =>  'nullable|string|max:191',
        ]);
        if($brand->pb_name != $request->post('pb_name')) {
            $request->validate([
                'pb_name'           => 'required|string|max:25|min:2|unique:product_brands'
            ]);
            $brand->pb_name = $request->post('pb_name');
        }

        $log = makeNewLog([
            'type'          => 'Brand Updated',
            'author_id'     => auth('admin')->id(),
            'author_name'   => auth('admin')->user()->name,
            'time'          => \Carbon\Carbon::now()
        ], $brand->pb_log, true);

        $brand->pb_name_bengali = $request->post('pb_name_bengali');
        $brand->pb_img = $request->post('pb_img');
        $brand->pb_website = $request->post('pb_website');
        $brand->pb_phone = $request->post('pb_phone');
        $brand->pb_email = $request->post('pb_email');
        $brand->pb_log = $log;

        if(!$brand->save()) {
            sendServerErrorJsonResponse();
        }

        return response()->json('Updated', 200);
    }

    public function delete($id) {
        $brand = ProductBrand::find($id);

        if(!$brand) {
            sendNotFoundJsonResponse('NOt Found');
        }

        if(!$brand->delete()) {
            sendServerErrorJsonResponse();
        }
        return response()->json('Deleted', 200);
    }

}
