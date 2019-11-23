<?php

namespace App\Http\Controllers\Admin\Axios;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Category;
use Mews\Purifier\Facades\Purifier;


class CategoriesController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware(['admin', 'checkSA', 'auth:admin']);
        $this->middleware('can:control-category')->only(['store', 'update', 'single']);
    }

    public function all() {
        $parent_categories = Category::where('category_active', '=', 1)
            ->where('category_type', '=', 'parent')
            ->orderBy('category_order')
            ->select(['category_id', 'category_title', 'category_title_bangla', 'category_type', 'category_parent_id'])
            ->get();
        $child_categories = Category::where('category_active', '=', 1)
            ->where('category_type', '=', 'child')
            ->orderBy('category_order')
            ->select(['category_id', 'category_title', 'category_title_bangla', 'category_type', 'category_parent_id'])
            ->get();
        $filtering_categories = Category::where('category_active', '=', 1)
            ->where('category_type', '=', 'filtering')
            ->orderBy('category_order')
            ->select(['category_id', 'category_title', 'category_title_bangla', 'category_type', 'category_parent_id'])
            ->get();

        $categories = [];

        foreach($parent_categories as $parent_category) {
            array_push($categories, $parent_category);
            foreach($child_categories as $child_category) {
                if($child_category->category_parent_id == $parent_category->category_id) {
                    array_push($categories, $child_category);
                    foreach($filtering_categories as $filtering_category) {
                        if($filtering_category->category_parent_id == $child_category->category_id) {
                            array_push($categories, $filtering_category);
                        }
                    }
                }
            }
        }

        return response()
            ->json($categories, 200);
    }

    public function parentCategoriesFor($for) {
        if($for == 'child') {
            $categories = Category::where('category_type', '=', 'parent')
                ->orderBy('category_order')
                ->get();
        }
        else if($for == 'filtering') {
            $categories = Category::whereIn('category_type', ['parent', 'child'])
                ->orderBy('category_order')
                ->get();
        }

        return response()
            ->json($categories, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'category_title'        => 'required|max:70|string',
            'category_title_bangla' => 'nullable|string|max:70',
            'category_description'  => 'required|string|min:50|max:255',
            'category_type'         => 'required|string'
        ]);

        if($request->post('category_type') != 'parent') {
            if($request->post('category_parent_id') == null) {
                return response()->json([
                    'code'      => 400,
                    'message'   => 'validation_error',
                    'error'     => 'Category parent can not be empty!'
                ], 400);
            }
            $category_order = Category::where('category_parent_id', '=', $request->post('category_parent_id'))
                ->max('category_order');
            if($category_order < $request->post('category_parent_id')) {
                $category_order += ($request->post('category_parent_id') + 0.01);
            }
            else {
                $category_order += 0.01;
            }
        }
        else {
            $category_order = Category::where('category_type', '=', 'parent')
                ->max('category_order');
            $category_order += 1.00;
        }

        $category_slug = createSlug(Category::class, 'category_slug', $request->post('category_title'), $request->post('category_title_bangla'));

        $category = new Category;

        $category->category_creator_id = auth('admin')->id();
        $category->category_title = $request->post('category_title');
        $category->category_title_bangla = $request->post('category_title_bangla');
        $category->category_description = $request->post('category_description');
        $category->category_slug = $category_slug;
        $category->category_type = $request->post('category_type');
        $category->category_img = $request->post('category_img');
        $category->category_parent_id = $request->post('category_parent_id');
        $category->category_active = ($request->post('category_active')) ? $request->post('category_active') : 1;
        $category->category_order = $category_order;

        $new_log = [
            'type'          => 'created',
            'author_id'     => auth('admin')->id(),
            'author_name'   => auth('admin')->user()->name,
            'time'          => Carbon::now()
        ];
        $category->category_log = makeNewLog($new_log, null, true);

        $category = $category->save();

        return response()->json($category, 200);
    }

    public function single($id) {
        $category = Category::find($id);

        if(!$category) {
            sendNotFoundJsonResponse('Category not found');
        }

        return response()->json($category, 200);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id) {
        $category = Category::find($id);

        if(!$category) {
            sendNotFoundJsonResponse('Category not found');
        }

        $request->validate([
            'category_title'        => 'required|max:70|string',
            'category_title_bangla' => 'nullable|string|max:70',
            'category_description'  => 'required|string|min:50|max:255',
            'category_type'         => 'required|string'
        ]);

        if($request->post('category_type') != 'parent') {
            if($request->post('category_parent_id') == null) {
                return response()->json([
                    'code'      => 400,
                    'message'   => 'validation_error',
                    'error'     => 'Category parent can not be empty!'
                ], 400);
            }
            if($category->category_parent_id != $request->post('category_parent_id')) {
                $category_order = Category::where('category_parent_id', '=', $request->post('category_parent_id'))
                    ->max('category_order');
                if($category_order < $request->post('category_parent_id')) {
                    $category_order += ($request->post('category_parent_id') + 0.01);
                }
                else {
                    $category_order += 0.01;
                }
                $category->category_order = $category_order;
            }
        }
        else if($request->category_type != $category->category_type) {
            $category_order = Category::where('category_type', '=', 'parent')
                ->max('category_order');
            $category_order += 1.00;
            $category->category_order = $category_order;
        }

        if($request->post('category_title') != $category->category_title || $request->post('category_title_bangla') != $category->category_title_bangla) {
            $category_slug = createSlug(Category::class, 'category_slug', $request->post('category_title'), $request->post('category_title_bangla'));
            $category->category_slug = $category_slug;
        }

        $category->category_title = $request->post('category_title');
        $category->category_title_bangla = $request->post('category_title_bangla');
        $category->category_description = $request->post('category_description');
        $category->category_type = $request->post('category_type');
        $category->category_img = $request->post('category_img');
        $category->category_parent_id = $request->post('category_parent_id');
        $category->category_active = ($request->post('category_active')) ? $request->post('category_active') : 1;

        $new_log = [
            'type'          => 'updated',
            'author_id'     => auth('admin')->id(),
            'author_name'   => auth('admin')->user()->name,
            'time'          => Carbon::now()
        ];
        $category->category_log = makeNewLog($new_log, $category->category_log, true);

        $category = $category->save();

        return response()->json($category, 200);
    }


}
