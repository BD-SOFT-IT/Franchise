<div class="product-details">
    <div class="row">
        <div class="col-md-5">

            <div class="product-images">

                <div class="exzoom" id="productSingleExZoom">
                    {{-- Images --}}
                    <div class="exzoom_img_box">
                        <ul class='exzoom_img_ul'>
                            <li>
                                @if($product->product_img_main && strlen($product->product_img_main) > 5)
                                    <img src="{{ imageCache($product->product_img_main, '400') }}" alt="{{ $product->product_title }}" class="hvr-buzz-out">
                                @elseif(getSiteBasic('default_product_image'))
                                    <img src="{{ imageCache(getSiteBasic('default_product_image')) }}" alt="{{ $product->product_title }}" class="hvr-buzz-out">
                                @else
                                    <img src="{{ staticAsset('theme/images/logos/default_product.png') }}" alt="{{ $product->product_title }}" class="hvr-buzz-out">
                                @endif
                            </li>
                            @if($product->product_img_2 && strlen($product->product_img_2) > 10)
                                <li>
                                    <img src="{{ imageCache($product->product_img_2) }}" alt="{{ $product->product_title }}">
                                </li>
                            @endif
                            @if($product->product_img_3 && strlen($product->product_img_3) > 10)
                                <li>
                                    <img src="{{ imageCache($product->product_img_3) }}" alt="{{ $product->product_title }}">
                                </li>
                            @endif
                            @if($product->product_img_4 && strlen($product->product_img_4) > 10)
                                <li>
                                    <img src="{{ imageCache($product->product_img_4) }}" alt="{{ $product->product_title }}">
                                </li>
                            @endif
                            @if($product->product_img_5 && strlen($product->product_img_5) > 10)
                                <li>
                                    <img src="{{ imageCache($product->product_img_5) }}" alt="{{ $product->product_title }}">
                                </li>
                            @endif
                        </ul>
                    </div>

                    <div class="exzoom_nav"></div>
                    <!-- Nav Buttons -->
                    <p class="exzoom_btn">
                        <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                        <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                    </p>
                </div>

            </div>

            @if(count(getFranchises($product)) > 0)
                <div class="select-franchise mt-5">
                    <label for="franchiseSelect">Franchise/Vendor</label>
                    <v-select placeholder="Select Franchise" label="name" id="franchiseSelect"
                              :options="{{ json_encode(getFranchises($product)) }}"
                              :reduce="productFranchise => productFranchise.id"
                              v-model="productFranchise">
                    </v-select>
                </div>
            @endif
        </div>

        <div class="col-md-7">
            <form action="#">
                <div class="product-content">
                    <h3 class="product-title">
                        {{ $product->product_title }}
                    </h3>

                    <div class="product-rating">

                    </div>

                    <div class="product-unit">
                        Unit: {{ floatval($product->product_unit_quantity) . ' ' . $product->product_unit_name }}
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

                    <div class="product-desc">
                        {{ Str::limit(strip_tags($product->product_description), 200) }}
                    </div>

                    @if($product->product_available_sizes || $product->product_available_colors)
                        <div class="product-options">
                            <h3 class="available-options-title">Available Options</h3>
                            @if($product->product_available_sizes)
                                <div class="select-sizes mb-4">
                                    <label for="sizeSelect">Size</label>
                                    <v-select placeholder="Select Size" id="sizeSelect"
                                              :options="{{ json_encode($product->product_available_sizes) }}"
                                              v-model="productSize">
                                    </v-select>
                                </div>
                            @endif

                            @if($product->product_available_colors)
                                <div class="select-colors mb-4">
                                    <label for="colorSelect">Color</label>
                                    <v-select placeholder="Select Color" id="colorSelect"
                                              :options="{{ json_encode($product->product_available_colors) }}"
                                              v-model="productColor">
                                    </v-select>
                                </div>
                            @endif
                        </div>
                    @endif

                    <div class="product-quantity">
                        <label for="productQuantity">Quantity</label>
                        <input id="productQuantity" type="number" min="1" name="product_quantity" v-model="productQuantity" class="form-control"
                               max="{{ ($product->product_units_max_selection && $product->product_units_max_selection > 1) ? $product->product_units_max_selection : 10 }}">

                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                    </div>


                    <div class="product-action">
                        <a href="javascript:void(0)" @click.prevent="addToCart({{ $product->product_id }})" data-id="{{ $product->product_id }}" class="add-to-cart-btn" id="staticAddCartBtn">
                            <i class="icon ion-md-cart"> </i> Add To Cart
                        </a>
                        <a href="javascript:void(0)" class="add-to-wishlist-btn" id="staticWishlistBtn" @click.prevent="addToWishList({{ $product->product_id }})">
                            <i class="icon ion-md-heart-empty" title="Add to Wish List"> </i>
                        </a>
                    </div>

                    <div class="product-share mt-3">
                        <label style="font-size: 14px;letter-spacing: 0.06em;font-weight: 600;text-transform: uppercase;line-height: 20px;">Share This Product</label>
                        {!! socialShareLinkGroup(['facebook', 'google', 'twitter', 'pinterest', 'linkedin'], null, $product->product_title, $product->product_img_main) !!}
                    </div>

                </div>
            </form>
        </div>

        <div class="col-12">
            <div class="product-details-spec">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Specification</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Reviews</a>
                    </li>
                </ul>
                <div class="tab-content" id="productTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="product-desc-full">
                            {!! $product->product_description !!}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <table class="table table-striped product-spec-table" style="font-size: 14px; letter-spacing: 0.03em;">
                            <tbody>
                                <tr>
                                    <th scope="row" class="text-right" style="width: 180px;">SKU:</th>
                                    <td>{{ $product->product_sku }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-right" style="width: 180px;">Brand:</th>
                                    <td>{{ ($product->brand && $product->brand->pb_name) ? $product->brand->pb_name : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-right" style="width: 180px;">Unit:</th>
                                    <td>{{ floatval($product->product_unit_quantity) . ' ' . $product->product_unit_name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-right" style="width: 180px;">Available Sizes:</th>
                                    <td>{{ $product->product_available_sizes ? implode(', ', $product->product_available_sizes) : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-right" style="width: 180px;">Available Colors:</th>
                                    <td>{{ $product->product_available_colors ? implode(', ', $product->product_available_colors) : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-right" style="width: 180px;">Availability:</th>
                                    <td>{{ $product->product_availability_status }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-right" style="width: 180px;">Guarantee Status:</th>
                                    <td>{{ $product->product_guarantee_status }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-right" style="width: 180px;">Return/Replacement:</th>
                                    <td>{{ 	$product->product_replacement_available ? 'Applicable' : 'Not Applicable' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                </div>
            </div>
        </div>
    </div>
</div>

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
