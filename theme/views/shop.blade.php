@extends('theme::layouts.app')

@section('title', $title . ' :: ')
@section('description', $description)
@section('keywords', $title)

@section('breadcrumb')
	@component('theme::components.breadcrumb', $breadcrumb)
	@endcomponent
@endsection

@section('content')
	@php($sidebar = getSiteBasic('page_sidebar', true))
	<section class="shop-section">
		<div class="container">
			<div class="row">
				@if(isset($error))
					<div class="col-12">
						<div class="alert alert-danger py-5 text-center" role="alert">
							<h3>Requested Search Not Found!</h3>
						</div>
					</div>
				@else
					@if($sidebar)
						<div class="col-lg-3">
							@include('theme::partials.shop-sidebar')
						</div>
					@endif
					<div class="{{ ($sidebar) ? 'col-lg-9' : 'col-12' }}">
						<div class="shop-content">
							@if(isset($category))
								<div class="shop-top-image">
									@if($catBanner = getBanners('category_page_banner_' . $category->category_id, true))
										<a class="product-grid d-block p-0" href="{{ $catBanner->banner_target_url }}" @if($catBanner->banner_target_url_type == 'external') target="_blank" @endif>
											<img src="{{ imageCache($catBanner->banner_img) }}" class="w-100 hvr-buzz-out" alt="" style="max-height: 220px;">
										</a>
									@else
										<a class="product-grid d-block p-0" href="#">
											<img src="https://via.placeholder.com/870x220?text=(870x220+px)" class="w-100 hvr-buzz-out" alt="" style="max-height: 220px;">
										</a>
									@endif
								</div>
							@endif

							<div class="shop-title">
								<h1>Shop List</h1>
							</div>

							<div class="shop-toolbar">
								<div class="row">
									<div class="col-md-4 product-view-icon text-sm-center text-md-left">
										<div class="btn-group" role="group" aria-label="Basic example">
											<button type="button" class="btn btn-secondary" id="grid-view-4-btn" @click="toggleProductsView('grid-view-4')">
												<i class="fa fa-th"></i>
											</button>
											<button type="button" class="btn btn-secondary active" id="grid-view-3-btn" @click="toggleProductsView('grid-view-3')">
												<i class="fa fa-th-large"></i>
											</button>
											<button type="button" class="btn btn-secondary" id="list-btn" @click="toggleProductsView('list')">
												<i class="fa fa-th-list"></i>
											</button>
										</div>
									</div>
									<div class="col-md-4 text-center product-sort-select">
										<label for="sortBy" class="sr-only">Sort By</label>
										<select id="sortBy" name="sortBy" class="niceSelect wide" @change="changeProductSorting($event)">
											<option data-display="" data-value="">Sort By</option>
											<option value="latest" {{ (request()->sortBy && request()->sortBy == 'latest') ? 'selected' : '' }}>Latest to Oldest</option>
											<option value="oldest" {{ (request()->sortBy && request()->sortBy == 'oldest') ? 'selected' : '' }}>Oldest to Latest</option>
											<option value="low" {{ (request()->sortBy && request()->sortBy == 'low') ? 'selected' : '' }}>Price: Low to High</option>
											<option value="high" {{ (request()->sortBy && request()->sortBy == 'high') ? 'selected' : '' }}>Price: High to Low</option>
											<option value="asc" {{ (request()->sortBy && request()->sortBy == 'asc') ? 'selected' : '' }}>Name: A to Z</option>
											<option value="desc" {{ (request()->sortBy && request()->sortBy == 'desc') ? 'selected' : '' }}>Name: Z to A</option>
										</select>
									</div>
									<div class="col-md-4 product-count text-sm-center text-md-right">
										<p>{{ 'Showing ' . (($products->perPage() * $products->currentPage()) - ($products->perPage() - 1)) . '-' . ($products->perPage() * $products->currentPage()) . ' of Total ' . $products->total() }}</p>
									</div>
								</div>
							</div>

							<div class="row product-wrapper m-0" :class="productView.type">
								@forelse($products as $index => $product)
									<div :class="productView.column">
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
								@empty
									<div class="col-12">
										<div role="alert" class="alert alert-danger text-center">
											No Products Found!
										</div>
									</div>
								@endforelse
							</div>
							<div class="product-pagination text-center">
								{{ $products->links() }}
							</div>
						</div>

						{{-- Index Small Banner --}}
						<section class="index-small-banner" style="margin-top: 130px;">
							<div class="container">
								<div class="row">
									@forelse(getBanners('index-main-banner') as $index => $banner)
										<div class="col-md-6">
											<div class="banner-content">
												<a href="{{ $banner->banner_target_url }}" @if($banner->banner_target_url_type == 'external') target="_blank" @endif>
													<img class="hvr-wobble-top" src="{{ imageCache($banner->banner_img) }}" alt="" style="height: 140px;">
												</a>
											</div>
										</div>
									@empty
										<div class="col-md-6">
											<div class="banner-content">
												<a href="#">
													<img class="hvr-wobble-top" src="{{ staticAsset('theme/images/banners/index_top_banner_1.jpg') }}" alt="" style="height: 140px;">
												</a>
											</div>
										</div>
										<div class="col-md-6">
											<div class="banner-content">
												<a href="#">
													<img class="hvr-wobble-top" src="{{ staticAsset('theme/images/banners/index_top_banner_2.jpg') }}" alt="" style="height: 140px;">
												</a>
											</div>
										</div>
									@endforelse
								</div>
							</div>
						</section>
						{{-- Index Small Banner End --}}
					</div>
				@endif
			</div>
		</div>
	</section>
@endsection
