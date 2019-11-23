@extends('theme::layouts.app')

@section('title', $title . ' :: ')
@section('description', Str::limit(strip_tags($description), 180))
@section('keywords', $keywords)

@if(isset($product) && $product)
    @section('og-meta')
        <meta property="og:title" content="{{ $product->product_title }}">
        <meta property="og:description" content="{{ Str::limit(strip_tags($description), 180) }}">
        <meta property="og:type" content="product">
        <meta property="og:url" content="{{ Request::fullUrl() }}">
        <meta property="og:site_name" content="{{ getSiteBasic('site_title') }}">
        <meta property="og:image" content="{{ imageCache($product->product_img_main) }}">
        <meta property="product:condition" content="new">
        <meta property="product:availability" content="{{ $product->product_availability_status }}">
        <meta property="product:price:amount" content="{{ $product->product_unit_mrp }}">
        <meta property="product:price:currency" content="BDT">

        <meta name="twitter:title" content="{{ $product->product_title }}">
        <meta name="twitter:description" content="{{ Str::limit(strip_tags($description), 180) }}">
        <meta name="twitter:image" content="{{ imageCache($product->product_img_main) }}">
        <meta name="twitter:card" content="{{ imageCache($product->product_img_main) }}">
    @endsection
@endif

@section('breadcrumb')
    @component('theme::components.breadcrumb', [
            'data'  => [
                ['url' => '#', 'title' => 'Shop']
            ],
            'active'   => $title
        ])
    @endcomponent
@endsection

@section('content')
    <section class="single-product-section">
        <div class="container">
            <div class="row">

                <div class="col-md-8 col-lg-9">
                    @if(isset($error))
                        <div class="alert alert-danger py-5" role="alert">
                            {{ $error }}
                        </div>
                    @else
                        @component('theme::components.product-single', ['product' => $product])

                        @endcomponent
                    @endif
                </div>

                <div class="col-md-4 col-lg-3">
                    <aside class="shop-sidebar">
                        <div class="shop-sidebar-image-top d-none d-lg-block">
                            @if($catBanner = getBanners('sidebar_banner', true))
                                <a class="d-block p-0" href="{{ $catBanner->banner_target_url }}" @if($catBanner->banner_target_url_type == 'external') target="_blank" @endif>
                                    <img src="{{ imageCache($catBanner->banner_img) }}" class="w-100 h-100" alt="">
                                </a>
                            @else
                                <a class="d-block p-0" href="#">
                                    <img src="https://via.placeholder.com/300x490?text=(300x490+px)" class="w-100 h-100" alt="">
                                </a>
                            @endif
                        </div>

                        {{--<div class="related-products">
                            <div class="row product-wrapper list-view m-0">
                                @forelse(getRelatedProducts($product->product_id) as $index => $product)
                                    <div class="col-12">
                                        @component('theme::components.product-grid', ['product' => $product])
                                            @slot('image')
                                                @if($product->product_img_main && strlen($product->product_img_main) > 5)
                                                    <img src="{{ imageCache($product->product_img_main, '80') }}" alt="{{ $product->product_title }}" class="hvr-buzz-out">
                                                @elseif(getSiteBasic('default_product_image'))
                                                    <img src="{{ imageCache(getSiteBasic('default_product_image')) }}" alt="{{ $product->product_title }}" class="hvr-buzz-out">
                                                @else
                                                    <img src="{{ staticAsset('theme/images/logos/default_product.png') }}" alt="{{ $product->product_title }}" class="hvr-buzz-out">
                                                @endif
                                            @endslot
                                        @endcomponent
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>--}}
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection
