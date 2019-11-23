<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function __construct() {
        $this->middleware(['checkSA', 'auth:admin', 'admin']);
        $this->middleware('can:manage-admin');
    }

    public function index() {
        $pages = Post::wherePostActive(true)
            ->orderBy('post_title')
            ->get();

        return view('admin.pages.index')
            ->with([
                'pages' => $pages
            ]);
    }

    public function create() {

    }

    public function edit($id) {
        $page = Post::findOrFail($id);

        return view('admin.pages.edit')
            ->with([
                'page'  => $page
            ]);
    }

    public function update(Request $request, $id) {
        $page = Post::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'post_title'        => ['required', 'string', 'min:3', 'max:180'],
            'post_description'  => ['required', 'string']
        ]);

        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->messages());
        }

        $page->post_title = $request->post('post_title');
        $page->post_description = \Purifier::clean($request->post('post_description'));

        $page->save();

        return redirect()->route('admin.pages')
            ->with('status', 'Page Updated Successfully!');
    }
}
