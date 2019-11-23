<h4 id="toggleFilterProduct" class="d-lg-none" v-tooltip.top-center="'Open Filter Menu'">
	Filter Products <i class="icon ion-ios-arrow-down"></i>
</h4>

<aside class="shop-sidebar" id="shopSidebar">
	<div class="shop-sidebar-image-top d-none d-lg-block">
		@if(Route::currentRouteName() == 'category.single' && isset($category) && $category->isParent())
			@if($catBanner = getBanners('category_sidebar_banner_' . $category->category_id, true))
				<a class="d-block p-0" href="{{ $catBanner->banner_target_url }}" @if($catBanner->banner_target_url_type == 'external') target="_blank" @endif>
					<img src="{{ imageCache($catBanner->banner_img) }}" class="w-100 h-100" alt="">
				</a>
			@else
				<a class="d-block p-0" href="#">
					<img src="https://via.placeholder.com/300x490?text=(300x490+px)" class="w-100 h-100" alt="">
				</a>
			@endif
		@else
			@if($catBanner = getBanners('sidebar_banner', true))
				<a class="d-block p-0" href="{{ $catBanner->banner_target_url }}" @if($catBanner->banner_target_url_type == 'external') target="_blank" @endif>
					<img src="{{ imageCache($catBanner->banner_img) }}" class="w-100 h-100" alt="">
				</a>
			@else
				<a class="d-block p-0" href="#">
					<img src="https://via.placeholder.com/300x490?text=(300x490+px)" class="w-100 h-100" alt="">
				</a>
			@endif
		@endif
	</div>

	<div class="sidebar-filter">
		<h2>Filter by Price</h2>
		<div id="priceRange"></div>
		<form id="filterForm" action="{{ request()->fullUrl() }}" method="get">
			<input type="hidden" name="minP" value="{{ request()->get('minP') ? request()->get('minP') : $minPrice }}">
			<input type="hidden" name="maxP" value="{{ request()->get('maxP') ? request()->get('maxP') : $maxPrice }}">
			<input type="hidden" name="size" value="{{ request()->get('size') }}">
			<input type="hidden" name="color" value="{{ request()->get('color') }}">
			<input type="hidden" name="brand" value="{{ request()->get('brand') }}">
			<input type="hidden" name="sortBy" value="{{ request()->get('sortBy') }}">
			<input type="hidden" name="page" value="{{ request()->get('page') }}">
			<button type="submit" class="btn btn-success float-right" style="margin-top: 15px;">Filter</button>
		</form>
	</div>

	<div class="sidebar-lists" style="margin-top: 70px;">
		<h2>Manufacturer</h2>
		<ul>
			@forelse($brands as $brand)
			<li>
				<a href="javascript:void(0)" @click.prevent="submitFilterParam('brand', '{{ $brand->pb_name }}')">{{ $brand->pb_name }}</a>
			</li>
			@empty

			@endforelse
		</ul>
	</div>

	<div class="sidebar-lists">
		<h2>Filter by Color</h2>
		<ul>
			@forelse($colors as $color)
				<li>
					<a href="javascript:void(0)" @click.prevent="submitFilterParam('color', '{{ $color }}')">{{ $color }}</a>
				</li>
			@empty
				<li>No Color Found</li>
			@endforelse
		</ul>
	</div>

	<div class="sidebar-lists">
		<h2>Filter by Size</h2>
		<ul>
			@forelse($sizes as $size)
				<li>
					<a href="javascript:void(0)" @click.prevent="submitFilterParam('size', '{{ $size }}')">{{ $size }}</a>
				</li>
			@empty
				<li>No Size Found</li>
			@endforelse
		</ul>
	</div>

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
</aside>
