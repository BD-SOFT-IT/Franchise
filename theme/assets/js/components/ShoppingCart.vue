<template>
    <section class="shopping-cart" id="shoppingCart" :class="{ 'cart-open': opened }">
        <div class="cart-header">
            <i class="icon ion-ios-cart"></i> <span style="font-weight: 900;">{{ cartItems.length }}</span> ITEMS
            <button class="float-right btn btn-outline-secondary text-white" @click.prevent="closeCart">Close</button>
        </div>

        <div v-if="cartItemCount > 0">
            <ul class="list-unstyled cart-items">
                <li class="media" v-for="product in cartItems">
                    <a :href="productSlug(product)">
                        <img :src="product.image" class="mr-3 align-self-center" :alt="product.title">
                    </a>
                    <div class="media-body">
                        <h5 class="mt-0 mb-1">
                            <a :href="productSlug(product)">{{ product.title }}</a>
                                <span class="close-btn" title="Remove from Cart" @click="deleteItem(product.uid, 1)">
                                <i class="icon ion-ios-close"></i>
                            </span>
                        </h5>

                        <small class="options d-block" style="padding: 3px 0 5px; font-size: 12px;">
                            <span v-if="product.size !== null" style="margin-right: 10px;">
                                Size: <strong>{{ product.size }}</strong>
                            </span>
                            <span v-if="product.color !== null">
                                Color: <strong>{{ product.color }}</strong>
                            </span>
                        </small>

                        <div class="quantity">
                            Quantity:
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-danger" title="Decrease" @click="deleteItem(product.uid, 0)" :disabled="product.qty === 1">-</button>
                                <button type="button" class="btn btn-light count">{{ product.qty }}</button>
                                <button type="button" class="btn btn-success" title="Increase" @click="increaseItem(product.id, product.uid)">+</button>
                            </div>
                        </div>
                        <p class="price">
                            <i class="sbicon sbicon-bdt"></i> {{ (product.qty * product.price).toFixed(2) }}
                        </p>
                    </div>
                </li>
            </ul>

            <div class="cart-footer">
                <div class="price-table">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td class="price-title">Sub-Total</td>
                            <td class="cart-price">{{ subtotal }}</td>
                        </tr>
                        <tr>
                            <td class="price-title">
                                Discount
                                <small>
                                    {{ discountText }}
                                </small>
                            </td>
                            <td class="cart-price">-{{ discountAmount }}</td>
                        </tr>
                        <tr>
                            <td class="price-title">
                                Shipping
                            </td>
                            <td class="cart-price">{{ shipping.charge.toFixed(2) }}</td>
                        </tr>
                        <tr class="total-price">
                            <td class="price-title">Total</td>
                            <td class="cart-price">
                                <i class="sbicon sbicon-bdt"></i> {{ cartTotal }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="coupon-form">
                    <form class="form-inline text-center" method="POST" @submit.prevent="validateCoupon">
                        <label class="sr-only" for="couponCodeInput">Coupon</label>
                        <input type="text" class="form-control mb-2 mr-sm-2" v-model="coupon" id="couponCodeInput" placeholder="Coupon Code" autofocus>

                        <button type="submit" class="btn btn-primary mb-2">Apply</button>
                    </form>
                </div>

                <div class="order-btn-wrapper">
                    <button class="btn btn-success w-100 text-center" @click="checkout"
                            :class="{'disabled' : cartItemCount <= 0 }" :disabled="cartItemCount <= 0" id="orderBtn">
                        Checkout
                    </button>
                </div>
            </div>
        </div>

        <div class="empty-cart" v-else>
            <div class="sad-emo text-center">
                <i class="icon ion-md-sad"></i>
            </div>

            <h4 class="w-100 text-center">
                You haven't Started Shopping Yet!
            </h4>
            <div class="start-shopping-btn text-center">
                <a href="/shop" class="btn btn-success">
                    Start Shopping
                </a>
            </div>
        </div>
    </section>
</template>

<script>

    export default {
        props:['opened'],
        data() {
            return {
                coupon: ''
            }
        },
        methods: {
            closeCart(){
                this.$emit('close');
            },
            increaseItem(id, uid) {
                this.$store.dispatch('addToCart', { id: id, qty: 1, uid: uid }).then(
                    (response) => {
                        this.$showSuccessSwal({ title: 'Added!', text: 'Successfully Added to Cart.' });
                    }, (error) => {
                        //console.log(error.response);
                        this.$showErrorSwal({ title: 'OOPS!', text: 'Something Wrong! Please try again or refresh page.' });
                    });
            },
            deleteItem(uid, destroy) {
                this.$store.dispatch('removeProduct', { uid: uid, destroy: destroy }).then(
                    (response) => {
                        this.$showSuccessSwal({ title: 'Done!', text: 'Successfully Removed.' });
                    }, (error) => {
                        this.$showErrorSwal({ title: 'OOPS!', text: 'Something Wrong! Please try again or refresh page.' });
                    });
            },
            validateCoupon() {
                this.$store.dispatch('validateCoupon', { coupon: this.coupon }).then(
                    (response) => {
                        this.$showSuccessModal({ title: response, text: this.successText });
                    }, (error) => {
                        this.$showErrorSwal({ title: 'OOPS!', text: error });
                    });
            },
            checkout() {
                if(this.cartItemCount > 0) {
                    window.location.href = '/checkout';
                }
            },
            productSlug(product) {
                let slug = product.slug;
                if(typeof product.fran !== 'undefined' && product.fran !== null) {
                    slug += ('?fra=' + product.fran);
                }
                return slug;
            }
        },
        watch: {
            'coupon': function(newVal) {
                if(newVal) {
                    this.coupon = newVal.toUpperCase();
                }
            }
        },
        computed: {
            cartItems() {
                return this.$store.getters.cartItems;
            },
            cartItemCount() {
                return this.$store.getters.cartItemCount;
            },
            subtotal() {
                return this.$store.getters.cartItemTotal.toFixed(2);
            },
            discountAmount() {
                return this.$store.getters.couponDiscount;
            },
            cartCoupon() {
                return this.$store.state.cart.coupon;
            },
            shipping() {
                return this.$store.state.cart.shipping;
            },
            cartTotal() {
                return this.$store.getters.cartTotal;
            },
            discountText() {
                let text = '';
                if(this.cartCoupon.code !== null) {
                    text = '(' + this.cartCoupon.code;
                    if(this.cartCoupon.percentage !== null) {
                        text += (' - ' + this.cartCoupon.percentage.toFixed(2) + '%)');
                    }
                    else {
                        text += ')';
                    }
                }
                return text;
            },
            successText() {
                let text = '';
                if(this.cartCoupon.code !== null) {
                    if(this.cartCoupon.percentage !== null) {
                        text += ('You have got ' + this.cartCoupon.percentage.toFixed(2) + '% Discount');
                    }
                    else {
                        text += ('You have got ' + this.cartCoupon.amount.toFixed(2) + ' TK Discount');
                    }
                }
                return text;
            }
        }
    }
</script>
