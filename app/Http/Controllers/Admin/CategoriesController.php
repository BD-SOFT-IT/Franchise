<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['admin', 'checkSA', 'auth:admin']);
        $this->middleware('can:control-category')->only(['create', 'edit']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parents = Category::where('category_active', '=', 1)
            ->where('category_type', '=', 'parent')
            ->orderBy('category_order')
            ->get();

        $children = Category::where('category_active', '=', 1)
            ->where('category_type', '=', 'child')
            ->orderBy('category_order')
            ->get();

        $filterings = Category::where('category_active', '=', 1)
            ->where('category_type', '=', 'filtering')
            ->orderBy('category_order')
            ->get();

        return view('admin.categories.index')
            ->with([
                'parents'    => $parents,
                'children'   => $children,
                'filterings' => $filterings,
                'summary'    => $this->getCategorySummary()
            ]);
    }

    public function create() {
        return view('admin.categories.create')
            ->with('summary', $this->getCategorySummary());
    }

    public function edit($id) {
        $category = Category::find($id);

        if(!$category) {
            abort(404);
        }

        return view('admin.categories.create')
            ->with([
                'categoryId' => $category->category_id,
                'summary'    => $this->getCategorySummary()
            ]);
    }


    /**
     * @return \stdClass
     */
    protected function getCategorySummary() {
        $main = Category::where('category_active', '=', 1)
            ->where('category_type', '=', 'parent')
            ->count();
        $sub = Category::where('category_active', '=', 1)
            ->where('category_type', '=', 'child')
            ->count();
        $filtering = Category::where('category_active', '=', 1)
            ->where('category_type', '=', 'filtering')
            ->count();
        $inactive = Category::where('category_active', '=', 0)
            ->count();

        $summary = new \stdClass();
        $summary->main = $main;
        $summary->sub = $sub;
        $summary->filtering = $filtering;
        $summary->inactive = $inactive;

        return $summary;
    }
}
