<?php

namespace Theme\Controllers;

use App\Http\Controllers\Controller;

class StaticPageController extends Controller
{
    public function privacyPolicy() {
        $privacy = getPage('privacy-policy');

        return view('theme::privacy-policy')->with('privacy', $privacy);
    }

    public function aboutUs() {
        $about = getPage('about-us');

        return view('theme::about-us')->with('about', $about);
    }

    public function contact() {
        return view('theme::contact');
    }

    public function shippingReturns() {
        $about = getPage('shipping-and-returns');

        return view('theme::shipping-and-returns')->with('about', $about);
    }

    public function deliveryInformation() {
        $about = getPage('delivery-information');

        return view('theme::delivery-information')->with('about', $about);
    }

    public function secureShopping() {
        $about = getPage('secure-shopping');

        return view('theme::secure-shopping')->with('about', $about);
    }

    public function termsConditions() {
        $about = getPage('terms-and-conditions');

        return view('theme::terms-and-conditions')->with('about', $about);
    }

    public function faq() {
        $about = getPage('frequently-asked-questions');

        return view('theme::faq')->with('about', $about);
    }
}
