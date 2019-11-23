<template>
    <section class="shopping-cart" id="shoppingCart">
        <div class="cart-header">
            <i class="fa fa-shopping-basket"></i> <span style="font-weight: 900;">{{ cartItems.length }}</span> ITEMS
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
                                <i class="fa fa-times"></i>
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
                                <button type="button" class="btn btn-danger" title="Decrease" @click="deleteItem(product.uid, 0)" :disabled="product.qty <= product.min">-</button>
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
                                Vat
                            </td>
                            <td class="cart-price">0.00</td>
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
                <i class="fa fa-frown-o"></i>
            </div>
            <h4 class="w-100 text-center">
                You haven't Added Anything to Cart Yet!
            </h4>
        </div>
    </section>
</template>

<script>

    export default {
        data() {
            return {
                showCheckout: false,
            }
        },
        methods: {
            closeCart(){
                this.$emit('close');
            },
            increaseItem(id, uid) {
                this.$store.dispatch('addToCart', { id: id, qty: 1, uid: uid }).then(
                    (response) => {
                        this.showToastMsg('Successfully Added to Cart.');
                    }, (error) => {
                        //console.log(error.response);
                        this.showToastMsg('Something Wrong! Please try again or refresh page.', 'error');
                    });
            },
            deleteItem(uid, destroy) {
                this.$store.dispatch('removeProduct', { uid: uid, destroy: destroy }).then(
                    (response) => {
                        this.showToastMsg('Successfully Removed.');
                    }, (error) => {
                        this.showToastMsg('Something Wrong! Please try again or refresh page.', 'error');
                    });
            },
            checkout() {
                if(this.cartItemCount > 0) {
                    window.location.href = '/bs-admin/shop/checkout';
                }
            },
            showToastMsg(msg, method = 'show', duration = 2500) {
                this.$toasted[method](msg, {
                    action : {
                        text : '',
                        icon: 'times',
                        onClick : (e, toastObject) => {
                            toastObject.goAway(0);
                        }
                    },
                    duration: duration
                });
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
            cartTotal() {
                return this.$store.getters.cartTotal;
            }
        }
    }
</script>
