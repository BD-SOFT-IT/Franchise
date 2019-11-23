<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\SiteOption;

class SitemapController extends Controller
{
    public function index() {
        $banners = Banner::whereBannerPosition('index-main-slider')
            ->get();

        return view('client.welcome')
            ->with([
                'banners'   => $banners
            ]);
    }

    public function siteMap() {
        $products = Product::where('product_active', '=', 1)
            ->orderBy('created_at')
            ->get();

        $categories = Category::where('category_active', '=', 1)
            ->orderBy('created_at')
            ->get();

        return response()
            ->view('sitemap', [
                'products'      => $products,
                'categories'    => $categories
            ])
            ->header('Content-Type', 'text/xml');
    }

    public function siteMapApiData() {
        $products = Product::where('product_active', '=', 1)
            ->orderBy('created_at')
            ->get();
        $categories = Category::where('category_active', '=', 1)
            ->orderBy('created_at')
            ->get();

        $static_routes = ['/', '/coupons', '/featured', '/discounts', '/offers'];
        $routes = [];
        foreach($static_routes as $static_route) {
            $route = new \stdClass();
            $route->url = $static_route;
            $route->changefreq = 'daily';
            $route->priority = ($static_route == '/') ? 1 : 0.9;
            array_push($routes, $route);
        }

        foreach($categories as $category) {
            $route = new \stdClass();
            $route->url = '/category/' . $category->category_slug;
            $route->changefreq = 'daily';
            $route->priority = 0.8;
            array_push($routes, $route);
        }

        foreach($products as $product) {
            $route = new \stdClass();
            $route->url = '/shop/' . $product->product_slug;
            $route->changefreq = 'weekly';
            $route->priority = 0.9;
            $route->lastmodISO = $product->updated_at->toAtomString();
            array_push($routes, $route);
        }

        $low_prio_routes = ['contact-us', 'about-us', 'privacy-policy', 'shipping-and-delivery', 'terms-of-use'];
        foreach($low_prio_routes as $static_route) {
            $route = new \stdClass();
            $route->url = $static_route;
            $route->priority = 0.8;
            array_push($routes, $route);
        }

        return response()
            ->json($routes, 200);
    }


    /**
     * @return array
     */
    protected function getBasicSiteData() {
        $basics = [];
        $so_names = ['site_title', 'site_logo', 'site_description', 'contact_phone', 'contact_email', 'site_keywords'];

        $contents = SiteOption::whereIn('so_name', $so_names)->get();
        foreach($contents as $content) {
            switch($content->so_name) {
                case 'site_title':
                    $basics = array_add($basics, 'title', $content->so_content);
                    break;
                case 'site_logo':
                    $basics = array_add($basics, 'logo', $content->so_content);
                    break;
                case 'site_description':
                    $basics = array_add($basics, 'description', $content->so_content);
                    break;
                case 'contact_phone':
                    $basics = array_add($basics, 'phone', $content->so_content);
                    break;
                case 'contact_email':
                    $basics = array_add($basics, 'email', $content->so_content);
                    break;
                case 'site_keywords':
                    $basics = array_add($basics, 'keywords', $content->so_content);
                    break;
            }
        }
        return $basics;
    }
}
