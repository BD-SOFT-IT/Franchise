<?php

namespace App\Http\Controllers\Admin\Axios;

use App\Models\Banner;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannersController extends Controller
{
    public function __construct() {
        $this->middleware(['admin', 'checkSA', 'auth:admin']);
        $this->middleware('can:manage-ads');
    }

    public function sliders() {
        $sliders = Banner::whereBannerPosition('index-main-slider')
            ->orderBy('banner_name')
            ->get();

        if(!$sliders || $sliders->count() <= 0) {
            for($n = 1; $n <= 5; $n++) {
                $this->createOrUpdateBanner('index_main_slider_' . $n, 'index-main-slider');
            }

            $sliders = Banner::whereBannerPosition('index-main-slider')
                ->orderBy('banner_name')
                ->get();
        }

        return response()->json($sliders, 200);
    }

    public function saveHomeSlider(Request $request) {
        if(!$request->post('banner_name') || !$request->post('banner_position') || $request->post('banner_position') !== 'index-main-slider') {
            return response()->json([
                'invalid' => 'Invalid Banner Data'
            ], 422);
        }
        if(!$this->createOrUpdateBanner($request->post('banner_name'), $request->post('banner_position'), $request->all())) {
            return sendServerErrorJsonResponse();
        }
        return response()->json([
            'status' => 'Successfully Updated'
        ], 200);
    }

    public function saveSliders(Request $request) {
        for($n = 1; $n <=5; $n++) {
            $name = 'index_main_slider_' . $n;
            if($request->exists($name)) {
                $img = $request->post($name);

                $this->createOrUpdateBanner($name, 'index-main-slider', $img);
            }

        }
        return response()->json([
            'status' => 'Successfully Updated'
        ], 200);
    }

    public function indexBanners() {
        $banners = Banner::whereBannerPosition('index-main-banner')
            ->orderBy('banner_name')
            ->get();
        if(!$banners || $banners->count() <= 0) {
            for($n = 1; $n <= 4; $n++) {
                $this->createOrUpdateBanner('index_main_banner_' . $n, 'index-main-banner');
            }
            $banners = Banner::whereBannerPosition('index-main-banner')
                ->orderBy('banner_name')
                ->get();
        }

        return response()->json($banners, 200);
    }

    public function updateIndexBanners(Request $request) {
        if(!$request->post('banner_name') || !$request->post('banner_position') || $request->post('banner_position') !== 'index-main-banner') {
            return response()->json([
                'invalid' => 'Invalid Banner Data'
            ], 422);
        }
        if(!$this->createOrUpdateBanner($request->post('banner_name'), $request->post('banner_position'), $request->all())) {
            return sendServerErrorJsonResponse();
        }
        return response()->json([
            'status' => 'Successfully Updated'
        ], 200);
    }

    public function categoryBanners($id) {
        $names = ['category_menu_banner_' . $id, 'category_page_banner_' . $id, 'category_sidebar_banner_' . $id];
        $banners = Banner::whereBannerPosition('category-banner')
            ->whereIn('banner_name', $names)
            ->orderBy('banner_name')
            ->get();

        if(!$banners || $banners->count() <= 0) {
            foreach($names as $name) {
                $this->createOrUpdateBanner($name, 'category-banner');
            }
            $banners = Banner::whereBannerPosition('category-banner')
                ->whereIn('banner_name', $names)
                ->orderBy('banner_name')
                ->get();
        }

        return response()->json($banners, 200);
    }

    public function updateCategoryBanner(Request $request) {
        if(!$request->post('banner_name') || !$request->post('banner_position') || $request->post('banner_position') !== 'category-banner') {
            return response()->json([
                'invalid' => 'Invalid Banner Data'
            ], 422);
        }
        if(!$this->createOrUpdateBanner($request->post('banner_name'), $request->post('banner_position'), $request->all())) {
            return sendServerErrorJsonResponse();
        }
        return response()->json([
            'status' => 'Successfully Updated'
        ], 200);
    }

    /**
     * @param string $name
     * @param string $position
     * @param array $data
     * @return bool
     */
    protected function createOrUpdateBanner(string $name, string $position, array $data = null) {
        $banner = Banner::whereBannerName($name)
            ->where('banner_position', '=', $position)
            ->first();

        if(!$banner) {
            $banner = new Banner();
            $banner->banner_name = $name;
            $banner->banner_position = $position;
        }
        $banner->banner_creator_id = Auth::guard('admin')->id();
        $banner->banner_img = ($data && $data['banner_img']) ? $data['banner_img'] : null;
        $banner->banner_target_text = ($data && $data['banner_target_text']) ? $data['banner_target_text'] : null;
        $banner->banner_target_url = ($data && $data['banner_target_url']) ? $data['banner_target_url'] : null;
        $banner->banner_target_url_type = ($data && $data['banner_target_url_type']) ? $data['banner_target_url_type'] : null;

        return $banner->save();
    }

}
