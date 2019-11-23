@extends('theme::layouts.app')

@section('title', 'Welcome :: ')
@section('description', getSiteBasic('site_description'))
@section('keywords', getSiteBasic('site_keywords'))

@section('og-meta')
    <meta property="og:title" content="{{ getSiteBasic('site_title') }}">
    <meta property="og:description" content="{{ getSiteBasic('site_description') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ Request::fullUrl() }}">
    <meta property="og:image" content="{{ imageCache(getSiteBasic('site_logo')) }}">

    <meta name="twitter:title" content="{{ getSiteBasic('site_title') }}">
    <meta name="twitter:description" content="{{ getSiteBasic('site_description') }}">
    <meta name="twitter:image" content="{{ imageCache(getSiteBasic('site_logo')) }}">
    <meta name="twitter:card" content="{{ imageCache(getSiteBasic('site_logo')) }}">
@endsection

@section('content')
    {{-- Index Slider --}}
    <section class="index-inner-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-9 offset-lg-4 offset-xl-3">
                    <div class="slider-wrapper">

                        <ul id="sb-slider" class="sb-slider">
                            @forelse(getBanners('index-main-slider') as $index => $banner)
                                <li>
                                    <a href="#" target="_blank">
                                        <img src="{{ imageCache($banner->banner_img, 'original') }}" alt="">
                                    </a>
                                    @if($banner->banner_target_url && $banner->banner_target_url != '#')
                                        <div class="sb-description">
                                            <a class="btn btn-info" href="{{ $banner->banner_target_url }}" @if($banner->banner_target_url_type == 'external') target="_blank" @endif>
                                                {{  $banner->banner_target_text }}
                                            </a>
                                        </div>
                                    @endif
                                </li>
                            @empty
                                <li>
                                    <a href="#" target="_blank">
                                        <img src="https://via.placeholder.com/1333x750?text=Promotional+Image(1335x750)" alt="">
                                    </a>
                                    <div class="sb-description">

                                    </div>
                                </li>
                            @endforelse
                        </ul>

                        <div id="nav-arrows" class="nav-arrows">
                            <a href="#" title="Next">Next</a>
                            <a href="#" title="Previous">Previous</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Index Slider End --}}

    {{-- Index Small Banner --}}
    <section class="index-small-banner">
        <div class="container">
            <div class="row">
                @forelse(getBanners('index-main-banner') as $index => $banner)
                    <div class="col-md-6">
                        <div class="banner-content">
                            <a href="{{ $banner->banner_target_url }}" @if($banner->banner_target_url_type == 'external') target="_blank" @endif>
                                <img class="hvr-wobble-top" src="{{ imageCache($banner->banner_img) }}" alt="">
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-md-6">
                        <div class="banner-content">
                            <a href="#">
                                <img class="hvr-wobble-top" src="{{ staticAsset('theme/images/banners/index_top_banner_1.jpg') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="banner-content">
                            <a href="#">
                                <img class="hvr-wobble-top" src="{{ staticAsset('theme/images/banners/index_top_banner_2.jpg') }}" alt="">
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    {{-- Index Small Banner End --}}

    {{-- Index Tabbed Products --}}
    <section class="index-tabbed-products">
        <div class="container">
            <ul class="nav nav-tabs" id="indexProductsTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="new-product-tab" data-toggle="tab" href="#newProducts" role="tab" aria-controls="newProducts" aria-selected="true">New Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="featured-products-tab" data-toggle="tab" href="#featuredProducts" role="tab" aria-controls="featuredProducts" aria-selected="false">Featured Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="offered-products-tab" data-toggle="tab" href="#offeredProducts" role="tab" aria-controls="offeredProducts" aria-selected="false">Offered Products</a>
                </li>
            </ul>
            <div class="tab-content" id="indexProductsTabContent">
                <div class="tab-pane fade show active" id="newProducts" role="tabpanel" aria-labelledby="new-product-tab">
                    <div class="row">
                        <div class="index-tabbed-carousel product-carousel owl-carousel owl-loaded owl-loaded">
                            @foreach(productsByType('new', 10) as $index => $product)
                                <div class="col-lg-3">
                                    @component('theme::components.product-grid', ['product' => $product])
                                        @slot('image')
                                            @if($product->product_img_main && strlen($product->product_img_main) > 5)
                                                <img src="{{ imageCache($product->product_img_main, '400') }}" alt="{{ $product->product_title }}" class="hvr-buzz-out">
                                            @elseif(getSiteBasic('default_product_image'))
                                                <img src="{{ imageCache(getSiteBasic('default_product_image')) }}" alt="{{ $product->product_title }}" class="hvr-buzz-out">
                                            @else
                                                <img src="{{ staticAsset('theme/images/logos/default_product.png') }}" alt="{{ $product->product_title }}" class="hvr-buzz-out">
                                            @endif
                                        @endslot
                                    @endcomponent
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="featuredProducts" role="tabpanel" aria-labelledby="featured-products-tab">
                    <div class="row">
                        <div class="index-tabbed-carousel product-carousel owl-carousel owl-loaded owl-loaded">
                            @foreach(productsByType('featured', 10) as $index => $product)
                                <div class="col-lg-3">
                                    @component('theme::components.product-grid', ['product' => $product])
                                        @slot('image')
                                            @if($product->product_img_main && strlen($product->product_img_main) > 5)
                                                <img src="{{ imageCache($product->product_img_main, '400') }}" alt="{{ $product->product_title }}" class="hvr-buzz-out">
                                            @elseif(getSiteBasic('default_product_image'))
                                                <img src="{{ imageCache(getSiteBasic('default_product_image')) }}" alt="{{ $product->product_title }}" class="hvr-buzz-out">
                                            @else
                                                <img src="{{ staticAsset('theme/images/logos/default_product.png') }}" alt="{{ $product->product_title }}" class="hvr-buzz-out">
                                            @endif
                                        @endslot
                                    @endcomponent
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="offeredProducts" role="tabpanel" aria-labelledby="offered-products-tab">
                    <div class="row">
                        <div class="index-tabbed-carousel product-carousel owl-carousel owl-loaded owl-loaded">
                            @foreach(productsByType('offered', 10) as $index => $product)
                                <div class="col-lg-3">
                                    @component('theme::components.product-grid', ['product' => $product])
                                        @slot('image')
                                            @if($product->product_img_main && strlen($product->product_img_main) > 5)
                                                <img src="{{ imageCache($product->product_img_main, '400') }}" alt="{{ $product->product_title }}" class="hvr-buzz-out">
                                            @elseif(getSiteBasic('default_product_image'))
                                                <img src="{{ imageCache(getSiteBasic('default_product_image')) }}" alt="{{ $product->product_title }}" class="hvr-buzz-out">
                                            @else
                                                <img src="{{ staticAsset('theme/images/logos/default_product.png') }}" alt="{{ $product->product_title }}" class="hvr-buzz-out">
                                            @endif
                                        @endslot
                                    @endcomponent
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Index Tabbed Products End --}}

    @forelse(getCategories() as $index => $category)
        <section class="categorised-products mb-5">
            <div class="container">
                <div class="card bsoft-card">
                    <div class="card-header">
                        <a href="{{ route('category.single', ['slug' => $category->category_slug]) }}">
                            {{ $category->category_title }}
                        </a>

                        <a class="float-right" style="font-size: 14px; color: var(--accent-color); text-transform: uppercase;"
                           href="{{ route('category.single', ['slug' => $category->category_slug]) }}"
                           v-tooltip.top-center="'View More Products for this Category'">
                            View More
                        </a>
                    </div>

                    <div class="card-body border-0 p-0">
                        <div class="row">
							<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                                @if($catBanner = getBanners('category_sidebar_banner_' . $category->category_id, true))
                                    <a class="product-grid d-block p-0" href="{{ $catBanner->banner_target_url }}" @if($catBanner->banner_target_url_type == 'external') target="_blank" @endif>
                                        <img src="{{ imageCache($catBanner->banner_img) }}" class="w-100 h-100" alt="">
                                    </a>
                                @else
                                    <a class="product-grid d-block p-0" href="#">
                                        <img src="https://via.placeholder.com/300x490?text=(300x490+px)" class="w-100 h-100" alt="">
                                    </a>
                                @endif
							</div>
                            @forelse($category->products as $p => $product)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                                    @component('theme::components.product-grid', ['product' => $product])
                                        @slot('image')
                                            @if($product->product_img_main && strlen($product->product_img_main) > 5)
                                                <img src="{{ imageCache($product->product_img_main, '400') }}" alt="{{ $product->product_title }}" class="hvr-buzz-out">
                                            @elseif(getSiteBasic('default_product_image'))
                                                <img src="{{ imageCache(getSiteBasic('default_product_image')) }}" alt="{{ $product->product_title }}" class="hvr-buzz-out">
                                            @else
                                                <img src="{{ staticAsset('theme/images/logos/default_product.png') }}" alt="{{ $product->product_title }}" class="hvr-buzz-out">
                                            @endif
                                        @endslot
                                    @endcomponent
                                </div>
                                @break($p >= 2)
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Index Small Banner --}}
        @php
            $banners = getBanners('index-main-banner', false, 4);
            if($banners && (intval($index) % 2 == 0)) {
                $banners = collect($banners)->splice(-2, 2);
            } else {
                $banners = collect($banners)->splice(0, 2);
            }
        @endphp
        <section class="index-small-banner">
            <div class="container">
                <div class="row">
                    @forelse($banners as $index => $banner)
                        <div class="col-md-6">
                            <div class="banner-content">
                                <a href="{{ $banner->banner_target_url }}" @if($banner->banner_target_url_type == 'external') target="_blank" @endif>
                                    <img class="hvr-wobble-top" src="{{ imageCache($banner->banner_img) }}" alt="">
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-6">
                            <div class="banner-content">
                                <a href="#">
                                    <img class="hvr-wobble-top" src="{{ staticAsset('theme/images/banners/index_top_banner_1.jpg') }}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="banner-content">
                                <a href="#">
                                    <img class="hvr-wobble-top" src="{{ staticAsset('theme/images/banners/index_top_banner_2.jpg') }}" alt="">
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
        {{-- Index Small Banner End --}}
    @empty
    @endforelse

@endsection
