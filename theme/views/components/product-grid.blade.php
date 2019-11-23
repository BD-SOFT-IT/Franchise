<div class="product-grid">
    <div class="product-image">
        <a href="{{ route('product.single', ['slug' => $product->product_slug]) }}">
            {{ $image }}
            {{--@if($product->product_img_main && strlen($product->product_img_main) > 5)
                <img src="{{ imageCache($product->product_img_main, '400') }}" alt="{{ $product->product_title }}">
            @else
                <img src="{{ asset('images/7.jpg') }}" alt="{{ $product->product_title }}">
            @endif--}}
        </a>

        @if($product->product_featured == 1)
            <div class="product-label featured-label">
                <span class="label-text">FEATURED</span>
            </div>
        @endif

        @if($product->product_discounted)
            <div class="product-label discounted-label">
                <span class="label-text">
                    @if($product->product_discount_amount && $product->product_discount_amount > 0)
                        - <i class="sbicon sbicon-bdt"></i>{{ $product->product_discount_amount }}
                    @else
                        - {{ $product->product_discount_percentage }} %
                    @endif
                </span>
            </div>
        @endif
        @if($product->product_offered)
            <div class="product-label offered-label">
                <span class="label-text">OFFERED</span>
            </div>
        @endif

        <div class="quick-button">
            <a href="javascript:void(0)" role="button" class="quick-view-btn" @click.prevent="openQuickViewModal({{ $product->product_id }})" v-tooltip.top-center="'Click to Quick View'">
                <i class="icon ion-ios-eye"></i>
            </a>

            <a href="javascript:void(0)" class="add-to-wishlist-btn" @click.prevent="addToWishList({{ $product->product_id }})" v-tooltip.top-center="'Add To Wishlist'" data-id="{{ $product->product_id }}">
                <i class="icon ion-md-heart-empty"></i>
            </a>
        </div>
    </div>

    <div class="product-content">
        <div class="product-title">
            <h4>
                <a href="{{ route('product.single', ['slug' => $product->product_slug]) }}">
                    {{ $product->product_title }}
                </a>
            </h4>
        </div>

        <div class="product-rating">

        </div>

        <div class="product-unit">
            {{ floatval($product->product_unit_quantity) . ' ' . $product->product_unit_name }}
        </div>

        <div class="product-price">
            @if($product->product_discounted == 0)
                <span class="current-price">
                    <i class="sbicon sbicon-bdt"></i>{{ number_format($product->product_unit_mrp, 2) }}
                </span>
            @else
                <span class="current-price">
                    <i class="sbicon sbicon-bdt"></i>{{ number_format($product->product_discounted_price, 2) }}
                </span>
                <span class="old-price">
                    <i class="sbicon sbicon-bdt"></i>{{ number_format($product->product_unit_mrp, 2) }}
                </span>
            @endif
        </div>

        <div class="product-action">
            <a href="javascript:void(0)" role="button" style="display: none;" class="quick-view-btn" @click="openQuickViewModal({{ $product->product_id }})" v-tooltip.top-center="'Click to Quick View'">
                <i class="icon ion-ios-eye"></i>
            </a>

            @if($product->product_available_sizes || $product->product_available_colors)
                <a href="{{ route('product.single', ['slug' => $product->product_slug]) }}" v-tooltip.top-center="'Click to Buy'">
                    <i class="icon ion-md-cart"></i> Buy Now
                </a>
            @else
                <a href="javascript:void(0)" v-tooltip.top-center="'Add to Cart'" @click="addToCart({{ $product->product_id }})" data-id="{{ $product->product_id }}">
                    <i class="icon ion-md-cart"></i> Add To Cart
                </a>
            @endif

            <a href="javascript:void(0)" style="display: none;" class="add-to-wishlist-btn" @click="addToWishList({{ $product->product_id }})" v-tooltip.top-center="'Add To Wishlist'" data-id="{{ $product->product_id }}">
                <i class="icon ion-md-heart-empty"></i>
            </a>
        </div>

        <div class="product-desc" style="display: none;">
            <p>{{ Str::limit(strip_tags($product->product_description), 180) }}</p>
        </div>

    </div>
</div>
