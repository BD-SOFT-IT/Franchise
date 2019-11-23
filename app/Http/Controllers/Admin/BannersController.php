<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannersController extends Controller
{
    public function __construct() {
        $this->middleware(['admin', 'checkSA', 'auth:admin']);
        $this->middleware('can:manage-ads');
    }

    public function sliders() {
        return view('admin.ads.sliders');
    }

    public function indexBanners() {
        return view('admin.ads.index_banners');
    }

    public function categoryBanners() {
        $categories = Category::whereCategoryActive(true)
            ->where('category_type', '=', 'parent')
            ->orderBy('category_title')
            ->select(['categories.category_id', 'categories.category_title'])
            ->get();
        return view('admin.ads.category_banners')
            ->with('categories', $categories);
    }

    public function sidebarBanner() {
        $banner = Banner::whereBannerPosition('sidebar-banner')->first();

        if(!$banner) {
            $this->createOrUpdateBanner('sidebar_banner', 'sidebar-banner');
            $banner = Banner::whereBannerPosition('sidebar-banner')->first();
        }

        return view('admin.ads.sidebar_banner')
            ->with([
                'banner'    => $banner
            ]);
    }

    public function updateSidebarBanner(Request $request) {
        $banner = Banner::whereBannerPosition('sidebar-banner')
            ->where('banner_name', '=', 'sidebar_banner')
            ->first();

        if($banner->banner_img !== $request->post('sidebar_banner')) {
            $banner->banner_img = $request->post('sidebar_banner');
            $banner->banner_creator_id = \Auth::guard('admin')->id();

            $banner->save();
        }

        return redirect()->back();
    }

    /**
     * @param string $name
     * @param string $position
     * @param string|null $img
     * @return bool
     */
    protected function createOrUpdateBanner(string $name, string $position, string $img = null) {
        $banner = Banner::whereBannerName($name)
            ->where('banner_position', '=', $position)
            ->first();

        if(!$banner) {
            $banner = new Banner();
            $banner->banner_name = $name;
            $banner->banner_position = $position;
            $banner->banner_img = $img;
            $banner->banner_creator_id = \Auth::guard('admin')->id();

            return $banner->save();
        }
        else if($banner->banner_img !== $img) {
            $banner->banner_img = $img;
            $banner->banner_creator_id = \Auth::guard('admin')->id();

            return $banner->save();
        }
        return true;
    }
}
