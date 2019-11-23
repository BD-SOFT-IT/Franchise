<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') {{ getSiteBasic('site_title') }}</title>

    {{-- Meta --}}
    <meta name="application-name" content="{{ getSiteBasic('site_title') }}">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="author" content="BD SOFT IT">
    <meta name="robots" content="index, follow">
    <meta name="copyright" {{ getSiteBasic('site_title') }}>
    <meta name="language" content="{{ app()->getLocale() }}">
    <meta name="Classification" content="E-Commerce">
    <meta name="designer" content="BD SOFT IT">
    <meta name="reply-to" content="support@bdsoftit.com">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    {{-- OG Data --}}
    @yield('og-meta')
    {{-- Search Engine Configuration --}}
    <meta name="google-site-verification" content="{{ getSiteBasic('google_seo') }}">
    <meta name="msvalidate.01" content="{{ getSiteBasic('bing_seo') }}">
    <meta name="p:domain_verify" content="{{ getSiteBasic('pinterest_seo') }}">
    <meta name="yandex" content="{{ getSiteBasic('yandex_seo') }}">
    {{-- Fonts & Styles --}}
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <link rel="preload" href="{{ staticAsset('theme/css/app.css') }}" as="style">
    @if(!getSiteBasic('site_theme') || getSiteBasic('site_theme') === 'dark')
        <link rel="preload" href="{{ staticAsset('theme/css/dark.css') }}" as="style">
    @else
        <link rel="preload" href="{{ staticAsset('theme/css/light.css') }}" as="style">
    @endif
    <script src="{{ staticAsset('theme/js/manifest.js') }}" defer></script>
    <script src="{{ staticAsset('theme/js/vendor.js') }}" defer></script>
    <script src="{{ staticAsset('theme/js/app.js') }}" defer></script>

    @php($accent = (getSiteBasic('theme_accent')) ? getSiteBasic('theme_accent') : ((!getSiteBasic('site_theme') || getSiteBasic('site_theme') === 'dark') ? '#20a385' : '#ea000d'))
    @php($txt = (getSiteBasic('theme_text') != null) ? getSiteBasic('theme_text') : '#262626')

    <style>
        :root {
            --accent-color: {{ $accent }};
            --txt-color: {{ $txt }};
        }
    </style>
    {{-- Core Styles --}}
    <link rel="stylesheet" href="{{ staticAsset('theme/css/app.css') }}">
    {{-- Theme Style --}}
    @if(!getSiteBasic('site_theme') || getSiteBasic('site_theme') == 'dark')
        <link rel="stylesheet" href="{{ staticAsset('theme/css/dark.css') }}">
    @else
        <link rel="stylesheet" href="{{ staticAsset('theme/css/light.css') }}">
    @endif

    @yield('styles')
</head>
<body>

@php($logo = getSiteBasic('site_logo'))
@php($title = getSiteBasic('site_title'))
@php($mobile = getSiteBasic('site_mobile'))

<div id="app">
    {{-- Header Start --}}
    <header id="header">
        <div class="header-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-center text-lg-left d-none d-md-block">
                        <p class="welcome-text">
                            Call Center:
                            <a class="hvr-grow" href="tel:{{ $mobile ? '+880' . $mobile : '+8801400883400' }}">
                                {{ $mobile ? mobileNumber($mobile) : '(+880) 1400 883400' }}
                            </a>
                        </p>
                    </div>

                    <div class="col-lg-8">
                        <div class="top-nav text-center text-lg-right">
                            <ul>
                                <li class="top-wishlist">
                                    <a href="{{ route('account') . '#accountWishlist' }}" @click.prevent="changeAccountTab($event, '#accountWishlist')" v-tooltip.top-bottom="'{{ auth()->check() ? "See Your Wishlist" : "Login to see wishlist" }}'">
                                        <i class="icon ion-md-heart"></i> Wishlist <span v-if="user" v-html="'(' + wishlist.length + ')'"></span>
                                    </a>
                                </li>
                                {{--<li class="top-lang">
                                    <a href="javascript:void(0)">
                                        <i class="icon ion-md-globe"></i> English <i class="icon ion-ios-arrow-down"></i>
                                    </a>
                                    <ul class="dropdown-lang">
                                        <li>
                                            <a href="#" v-tooltip.top-bottom="'Change Language to English'">English</a>
                                        </li>
                                        <li>
                                            <a href="#" v-tooltip.top-bottom="'বাংলা ভাষা আয়ত্তগত নয়'">
                                                <span class="adorsho-lipi-11 text-black-50">বাংলা</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>--}}
                                @guest
{{--                                    <li class="top-login">--}}
{{--                                        <a href="{{ route('franchise.register') }}">--}}
{{--                                            <i class="icon ion-md-wallet"></i> Franchise/Affiliate--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
                                    <li class="top-login">
                                        <a href="{{ route('login') }}" v-tooltip.top-bottom="'Click to Login'">
                                            <i class="icon ion-ios-log-in"></i> Login
                                        </a>
                                    </li>
                                @endguest

                                @auth
                                    <li class="top-links">
                                        <a href="javascript:void(0)">
                                            <i class="icon ion-ios-person"></i> My Account <i class="icon ion-ios-arrow-down"></i>
                                        </a>
                                        <ul class="dropdown-links">
                                            <li>
                                                <a href="{{ route('account') . '#accountProfile' }}" @click.prevent="changeAccountTab($event, '#accountProfile')">Profile</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('account') . '#accountOrders' }}" @click.prevent="changeAccountTab($event, '#accountOrders')">Orders</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('checkout') }}">Checkout</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                    Logout
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endauth
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-main">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3">
                        <div class="logo">
                            <a href="{{ route('index') }}" class="d-block text-center">
                                @if($logo && strlen($logo) > 10)
                                    <img src="{{ imageToDataUrl(storage_path('uploads/' . $logo)) }}" alt="{{ $title }}">
                                @else
                                    <h3>{{ $title }}</h3>
                                @endif
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="header-middle">
                            <div class="search-container">
                                <form action="#" id="searchForm">
                                    <div class="search-box">
                                        <live-search></live-search>
                                        {{--<input type="text" placeholder="Search for product...." name="q">
                                        <button type="submit">
                                            <i class="icon ion-ios-search"></i>
                                        </button>--}}
                                    </div>
                                </form>
                            </div>

                            <div class="header-cart-wrapper" @click.prevent="toggleCart" v-tooltip.top-center="'Click to Open Cart'">
                                <a href="javascript:void(0)">
                                    <i class="icon ion-ios-cart"></i>
                                    <span v-html="cartWrapperHTML"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-xl-3 cat-menu-col">
                        @include('theme::partials.main-menu')
                    </div>

                    <div class="col-lg-8 col-xl-9 head-menu-col">
                        <div class="header-bottom-menu">
                            <nav>
                                <ul>
                                    <li class="d-none d-sm-inline-block">
                                        <a href="{{ route('shop') }}">
                                            <i class="icon ion-md-home"></i> Shop
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('about-us') }}">
                                            <i class="icon ion-md-information-circle"></i> About US
                                        </a>
                                    </li>

                                    {{--<li>
                                        <a href="{{ route('contact') }}">
                                            <i class="icon ion-md-map"></i> Contact US
                                        </a>
                                    </li>--}}

                                    <li>
                                        <a href="#" role="button" data-toggle="modal" data-target="#trackOrderModal">
                                            <i class="icon ion-md-locate"> </i> Track Order
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    {{-- Header End --}}

    {{-- Main Start --}}
    <main id="main">
		<div class="breadcrumbs-area">
			<div class="container">
				@yield('breadcrumb')
			</div>
		</div>
        @yield('content')
    </main>
    {{-- Main End --}}

    {{-- Footer Start --}}
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="footer-info mb-5 mb-md-0">
                            <a href="{{ route('index') }}" class="footer-logo">
                                <img src="{{ ($logo && strlen($logo) > 0) ? imageToDataUrl(storage_path('uploads/' . $logo)) : 'https://via.placeholder.com/215x70' }}" alt="">
                            </a>
                            <div class="footer-contact">
                                <ul>
                                    <li>
                                        <i class="icon ion-ios-home"></i>
                                        <a href="{{ urldecode(getSiteBasic('map_address')) }}" target="_blank" v-tooltip.top-start="'View in Google Map'">
                                            <span>{{ getSiteBasic('site_address') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <i class="icon ion-ios-call"></i>
                                        <a href="tel:{{ mobileNumber($mobile) }}" v-tooltip.top-start="'Click to Call Helpline'">
                                            <span>{{ mobileNumber($mobile) }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <i class="icon ion-ios-mail"></i>
                                        <a href="mailto:{{ getSiteBasic('site_email') }}?subject=Feedback&body=Write Your Questions Here......" v-tooltip.top-start="'Click to Mail for Support'">
                                            <span>{{ getSiteBasic('site_email') }}</span>
                                        </a>

                                    </li>
                                </ul>
                            </div>
                            <div class="footer-social">
                                <ul>
                                    <li>
                                        <a href="{{ getSiteBasic('facebook_page') }}" target="_blank" v-tooltip.top-center="'View Facebook Page'" style="background-color: #1b78c6;">
                                            <i class="icon ion-logo-facebook"></i>
                                        </a>
                                        <div class="social-title">
                                            <p>Find Us</p>
                                            <h3>Facebook</h3>
                                        </div>
                                    </li>

                                    <li>
                                        <a href="{{ getSiteBasic('twitter_page') }}" target="_blank" v-tooltip.top-center="'View Twitter Page'" style="background-color: #00bff3;">
                                            <i class="icon ion-logo-twitter"></i>
                                        </a>
                                        <div class="social-title">
                                            <p>Follow Us</p>
                                            <h3>Twitter</h3>
                                        </div>
                                    </li>

                                    <li>
                                        <a href="{{ getSiteBasic('youtube_channel') }}" target="_blank" v-tooltip.top-center="'View Youtube Channel'" style="background-color: #f75a53;">
                                            <i class="icon ion-logo-youtube"></i>
                                        </a>
                                        <div class="social-title">
                                            <p>Subscribe</p>
                                            <h3>Youtube</h3>
                                        </div>
                                    </li>

                                    <li>
                                        <a href="{{ getSiteBasic('instagram_page') }}" target="_blank" v-tooltip.top-center="'View Instagram Page'" style="background-color: #f06b78;">
                                            <i class="icon ion-logo-instagram"></i>
                                        </a>
                                        <div class="social-title">
                                            <p>Follow Us</p>
                                            <h3>Instagram</h3>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="footer-links mb-5 mb-md-0">
                                    <h3>CUSTOMER SERVICE</h3>
                                    <div class="footer-menu">
                                        <ul>
                                            <li><a href="{{ route('shipping-and-returns') }}">Shipping & Returns</a></li>
                                            <li><a href="{{ route('delivery-information') }}">Delivery Information</a></li>
                                            <li><a href="{{ route('secure-shopping') }}"> Secure Shopping</a></li>
                                            <li><a href="#">International Shipping</a></li>
                                            <li><a href="#"> Affiliates/Franchise</a></li>
                                            <li><a href="{{ route('contact') }}"> Contact</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="footer-links">
                                    <h3>Information</h3>
                                    <div class="footer-menu">
                                        <ul>
                                            <li><a href="{{ route('about-us') }}">About Us</a></li>
                                            <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                                            <li><a href="#">Blog</a></li>
                                            <li><a href="#">Portfolio</a></li>
                                            <li><a href="{{ route('terms-and-conditions') }}">Terms & Conditions</a></li>
                                            <li><a href="{{ route('faq') }}">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="copyright text-center text-md-left mb-2 mb-md-0">
                            Copyright &copy; {{ date('Y') }} <a href="{{ route('index') }}">{{ $title }}</a>. All Rights Reserved.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="credit text-center text-md-right">
                            Designed & Developed by: <a href="https://bdsoftit.com" target="_blank" title="A Creative Software Company">BD SOFT IT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    {{-- Footer End --}}

    {{-- Order Track Modal --}}
    <div class="modal fade" id="trackOrderModal" tabindex="-1" role="dialog" aria-labelledby="trackOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="javascript:void(0)" class="text-center" @submit.prevent="trackOrder">
                    @csrf
                    <div class="modal-header w-100">
                        <h5 class="modal-title text-center w-100" id="trackOrderModalLabel">Track Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group text-center">
                            <label for="order_no">Enter You Order No</label>
                            <br>
                            <input v-model="orderTrackNo" type="text" class="form-control text-center" id="order_no" name="order_no" required autofocus>
                        </div>
                    </div>
                    <div class="modal-footer text-center d-block">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <shopping-cart
            :opened="cartOpen"
            @close="toggleCart">
    </shopping-cart>

    <div class="quickViewModalWrapper">
        <quick-view
                :product="quickViewProduct.product"
                :franchise="quickViewProduct.franchise"
                img-url="{{ imageCache('/', 'original') }}"
                @cart="addToCartWithOption"
                @wishlist="addToWishList"
                @close="closeQuickViewModal"
                v-if="quickViewProduct.product !== null">
        </quick-view>
    </div>

    <div class="loading-spinner" v-if="loading">
        <hash-loader
                class="custom-loader"
                color="{{ $accent }}"
                :loading="loading"
                :size="50"
                :size-unit="'px'">
        </hash-loader>
    </div>

    {!!
        socialShareLinkGroup(
            ['facebook', 'google', 'twitter', 'pinterest', 'linkedin', 'reddit'],
            null, null, null,
            ['position' => 'fixed', 'float' => 'left', 'show' => 'vertical']
        )
     !!}

</div>

@yield('script')

{{--@if(config('app.env') === 'local')
    <script src="http://localhost:35729/livereload.js"></script>
@endif--}}

</body>
</html>
