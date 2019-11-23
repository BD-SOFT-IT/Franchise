<template>
    <div id="quickModal" class="modal animated zoomIn" tabindex="-1" data-easein="expandIn" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <button type="button" class="close" @click.prevent="closeModal">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="modal-body">
                    <div class="product-details">
                        <div class="row">
                            <div class="col-md-5">

                                <div class="product-images">
                                    <div class="exzoom" id="productSingleExZoom">
                                        <div class="exzoom_img_box">
                                            <ul class='exzoom_img_ul'>
                                                <li>
                                                    <img :src="imgUrl + '/' + product.product_img_main" :alt="product.product_title" v-if="typeof product.product_img_main === 'string' && product.product_img_main.length > 10">
                                                    <img :src="'/static/theme/images/logos/default_product.png'" :alt="product.product_title" v-else>
                                                </li>

                                                <li v-if="typeof product.product_img_2 === 'string' && product.product_img_2.length > 10">
                                                    <img :src="imgUrl + '/' + product.product_img_2" :alt="product.product_title">
                                                </li>

                                                <li v-if="typeof product.product_img_3 === 'string' && product.product_img_3.length > 10">
                                                    <img :src="imgUrl + '/' + product.product_img_3" :alt="product.product_title">
                                                </li>

                                                <li v-if="typeof product.product_img_4 === 'string' && product.product_img_4.length > 10">
                                                    <img :src="imgUrl + '/' + product.product_img_4" :alt="product.product_title">
                                                </li>

                                                <li v-if="typeof product.product_img_5 === 'string' && product.product_img_5.length > 10">
                                                    <img :src="imgUrl + '/' + product.product_img_5" :alt="product.product_title">
                                                </li>
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

                                <div class="select-franchise mt-5" v-if="franchise.length > 0">
                                    <label for="franchiseSelect">Franchise/Vendor</label>
                                    <v-select placeholder="Select Franchise" label="name" id="franchiseSelect"
                                              :options="franchise"
                                              :reduce="productFranchise => productFranchise.id"
                                              v-model="productFranchise">
                                    </v-select>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <form action="#">
                                    <div class="product-content">
                                        <h3 class="product-title">
                                            {{ product.product_title }}
                                        </h3>

                                        <div class="product-rating">

                                        </div>

                                        <div class="product-price">

                                            <span class="current-price" v-if="product.product_discounted === 0">
                                                <i class="sbicon sbicon-bdt"></i>{{ parseFloat(product.product_unit_mrp).toFixed(2) }}
                                            </span>

                                            <span class="current-price" v-if="product.product_discounted === 1">
                                                <i class="sbicon sbicon-bdt"></i>{{ parseFloat(product.product_discounted_price).toFixed(2) }}
                                            </span>
                                            <span class="old-price" v-if="product.product_discounted === 1">
                                                <i class="sbicon sbicon-bdt"></i>{{ parseFloat(product.product_unit_mrp).toFixed(2) }}
                                            </span>

                                        </div>

                                        <div class="product-desc" v-html="product.product_description">

                                        </div>

                                        <div class="product-options" v-if="Array.isArray(product.product_available_sizes) || Array.isArray(product.product_available_colors)">
                                            <h3 class="available-options-title">Available Options</h3>

                                            <div class="select-sizes mb-4" v-if="Array.isArray(product.product_available_sizes) && product.product_available_sizes.length > 0">
                                                <label for="sizeSelect">Size</label>
                                                <v-select placeholder="Select Size" id="sizeSelect"
                                                          :options="product.product_available_sizes"
                                                          v-model="productSize">
                                                </v-select>
                                            </div>

                                            <div class="select-colors mb-4" v-if="Array.isArray(product.product_available_colors) && product.product_available_colors.length > 0">
                                                <label for="colorSelect">Color</label>
                                                <v-select placeholder="Select Color" id="colorSelect"
                                                          :options="product.product_available_colors"
                                                          v-model="productColor">
                                                </v-select>
                                            </div>

                                        </div>

                                        <div class="product-quantity">
                                            <label for="productQuantity">Quantity</label>
                                            <input id="productQuantity" type="number" :min="1" name="product_quantity" v-model="quantity" class="form-control"
                                                   :max="(product.product_units_max_selection && product.product_units_max_selection > 1) ? product.product_units_max_selection : 10">

                                            <input type="hidden" name="product_id" :value="product.product_id">
                                        </div>

                                        <div class="product-action">
                                            <a href="javascript:void(0)" @click="addToCart(product.product_id)" class="add-to-cart-btn" id="staticAddCartBtn">
                                                <i class="icon ion-md-cart"></i> Add To Cart
                                            </a>
                                            <a href="javascript:void(0)" @click="addToWishlist(product.product_id)" class="add-to-wishlist-btn" id="staticWishlistBtn">
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

</template>

<script>
    export default {
        name: 'quick-view-modal',
        props: ['product', 'franchise', 'imgUrl'],
        data() {
            return {
                quantity: 1,
                productFranchise: null,
                productColor: null,
                productSize: null
            }
        },
        methods: {
            addToCart(id) {
                this.$emit('cart', { id: id, qty: this.quantity, size: this.productSize, color: this.productColor, franchise: this.productFranchise });
            },
            addToWishlist(id) {
                this.$emit('wishlist', id);
            },
            closeModal() {
                this.$emit('close');
            }
        }
    }
</script>
