<?php

namespace App\Http\Controllers\Admin;

use App\Models\SiteOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SiteOptionsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware(['admin', 'checkSA', 'auth:admin']);
        $this->middleware('can:manage-options');
    }

    public function index() {
        return view('admin.site-information.index');
    }

    public function config() {
        return view('admin.site-information.config');
    }

    public function seo() {
        return view('admin.site-information.seo');
    }

    public function social() {
        return view('admin.site-information.social');
    }

    public function saveSeo(Request $request) {

        if($request->post('google_seo')) {
            $this->createOrUpdateOption('google_seo', $request->post('google_seo'));
        }
        if($request->post('bing_seo')) {
            $this->createOrUpdateOption('bing_seo', $request->post('bing_seo'));
        }
        if($request->post('yandex_seo')) {
            $this->createOrUpdateOption('yandex_seo', $request->post('yandex_seo'));
        }
        if($request->post('pinterest_seo')) {
            $this->createOrUpdateOption('pinterest_seo', $request->post('pinterest_seo'));
        }

        return redirect()->back()
            ->with('status', 'SEO Data Updated Successfully..!!!');
    }

    public function saveSocial(Request $request) {
        if($request->post('facebook_page')) {
            $this->createOrUpdateOption('facebook_page', $request->post('facebook_page'));
        }
        if($request->post('youtube_channel')) {
            $this->createOrUpdateOption('youtube_channel', $request->post('youtube_channel'));
        }
        if($request->post('instagram_page')) {
            $this->createOrUpdateOption('instagram_page', $request->post('instagram_page'));
        }
        if($request->post('twitter_page')) {
            $this->createOrUpdateOption('twitter_page', $request->post('twitter_page'));
        }

        return redirect()->back()
            ->with('status', 'Social Links Updated successfully..!!!');
    }

    public function save(Request $request) {
        $this->createOrUpdateOption('site_title', $request->post('site_title'));

        $this->createOrUpdateOption('site_mobile', mobileNumberForStore($request->post('site_mobile')));

        if($request->post('site_email')) {
            $this->createOrUpdateOption('site_email', $request->post('site_email'));
        }

        if($request->post('site_description')) {
            $this->createOrUpdateOption('site_description', $request->post('site_description'));
        }

        if($request->post('site_address')) {
            $this->createOrUpdateOption('site_address', $request->post('site_address'));
        }

        if($request->post('map_address')) {
            if($request->post('map_address')) {
                $this->createOrUpdateOption('map_address', urlencode($request->post('map_address')));
            }
        }

        if($request->post('site_keywords')) {
            $this->createOrUpdateOption('site_keywords', $request->post('site_keywords'));
        }

        if($request->post('site_logo')) {
            $this->createOrUpdateOption('site_logo', $request->post('site_logo'));
        }


        return redirect()->back()
            ->with('status', 'Site Data Updated successfully..!!!');
    }

    public function saveConfig(Request $request) {
        if($request->post('default_product_image')) {
            $this->createOrUpdateOption('default_product_image', $request->post('default_product_image'));
        }
        if($request->post('invoice_logo')) {
            $this->createOrUpdateOption('invoice_logo', $request->post('invoice_logo'));
        }
        return redirect()->back()
            ->with('status', 'Site Configuration Data Updated successfully..!!!');
    }

    public function saveFrontThemeColor(Request $request) {
        $this->createOrUpdateOption('site_theme', $request->post('site_theme'));
        $this->createOrUpdateOption('theme_accent', $request->post('theme_accent'));
        //$this->createOrUpdateOption('theme_text', $request->post('theme_text'));

        return redirect()->back()->with('status', 'New Theme Successfully Updated..!!!');
    }



    /**
     * @param string $name
     * @param string $value
     * @return bool
     */
    protected function createOrUpdateOption(string $name, string $value) {
        $option = SiteOption::where('so_name', '=', $name)->first();
        if(!$option) {
            $option = new SiteOption();
            $option->so_name = $name;
        }
        $option->so_content = $value;
        $option->so_modifier_id = \Auth::id();

        return $option->save();
    }

}
