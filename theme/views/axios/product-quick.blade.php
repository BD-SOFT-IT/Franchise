<div id="quickModal" class="modal animated zoomIn" tabindex="-1" data-easein="expandIn" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

            <div class="modal-body">
                <div class="product-details">
                    <div class="row">
                        <div class="col-md-5">

                            <div class="product-images">

                                <div class="exzoom" id="productSingleExZoom">
                                    {{-- Images --}}
                                    <div class="exzoom_img_box">
                                        <ul class='exzoom_img_ul'>
                                            <li>
                                                @if($product->product_img_main && strlen($product->product_img_main) > 10)
                                                    <img src="{{ imageCache($product->product_img_main) }}" alt="{{ $product->product_title }}">
                                                @else
                                                    <img src="{{ asset('theme/images/products/22.jpg') }}" alt="{{ $product->product_title }}">
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
                        </div>

                        <div class="col-md-7">
                            <form action="#">
                                <div class="product-content">
                                    <h3 class="product-title">
                                        {{ $product->product_title }}
                                    </h3>

                                    <div class="product-rating">

                                    </div>

                                    <div class="product-price">
                                        @if($product->product_discounted == 0)
                                            <span class="current-price">
                            <i class="sbicon sbicon-bdt"></i>{{ number_format($product->product_unit_mrp, 2) }}
                        </span>
                                        @else
                                            <span class="current-price">
                            <i class="sbicon sbicon-bdt"></i>{{ number_format(getDiscountedAmount($product->product_unit_mrp, $product->product_discount_amount, $product->product_discount_percentage), 2) }}
                        </span>
                                            <span class="old-price">
                            <i class="sbicon sbicon-bdt"></i>{{ number_format($product->product_unit_mrp, 2) }}
                        </span>
                                        @endif
                                    </div>

                                    <div class="product-desc">
                                        {!! $product->product_description !!}
                                    </div>

                                    @if($product->product_available_sizes || $product->product_available_colors)
                                        <div class="product-options">
                                            <h3 class="available-options-title">Available Options</h3>
                                            @if($product->product_available_sizes && strlen($product->product_available_sizes) > 5)
                                                <div class="select-sizes">
                                                    <label for="sizeSelect">Size</label>
                                                    <select id="sizeSelect" name="product_size" class="niceSelect wide" required>
                                                        <option data-display="Select Size">Select Size</option>
                                                        @foreach(convertStringToArray($product->product_available_sizes) as $index => $size)
                                                            <option value="{{ $size }}">{{ $size }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif

                                            @if($product->product_available_colors && strlen($product->product_available_colors) > 5)
                                                <div class="select-colors">
                                                    <label for="colorSelect">Color</label>
                                                    <select id="colorSelect" name="product_color" class="niceSelect wide" required>
                                                        <option data-display="Select Color">Select Color</option>
                                                        @foreach(convertStringToArray($product->product_available_colors) as $index => $color)
                                                            <option value="{{ $color }}">{{ $color }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                        </div>
                                    @endif

                                    <div class="product-quantity">
                                        <label for="productQuantity">Quantity</label>
                                        <input id="productQuantity" type="number" min="1" name="product_quantity" value="1" class="form-control"
                                               max="{{ ($product->product_units_max_selection && $product->product_units_max_selection > 1) ? $product->product_units_max_selection : 10 }}">

                                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                    </div>


                                    <div class="product-action">
                                        <a href="javascript:void(0)" @click="addToCart({{ $product->product_id }})" data-id="{{ $product->product_id }}" class="add-to-cart-btn" id="staticAddCartBtn">
                                            <i class="icon ion-md-cart"></i> Add To Cart
                                        </a>
                                        <a href="javascript:void(0)" class="add-to-wishlist-btn" id="staticWishlistBtn">
                                            <i class="icon ion-md-heart-empty" title="Add to Wish List"></i>
                                        </a>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
