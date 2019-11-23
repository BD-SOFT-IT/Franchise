require('./bootstrap');

window.Vue = require('vue');

Vue.config.productionTip = false;

require('owl.carousel/dist/owl.carousel');

import { VueSpinners } from '@saeris/vue-spinners';
Vue.use(VueSpinners);

import VTooltip from 'v-tooltip';
Vue.use(VTooltip);

import VeeValidate from './partials/vee-validate';

Vue.use(VeeValidate, {
    classes: true,
    classNames: {
        valid: 'is-valid',
        invalid: 'is-invalid'
    },
});

require('../plugins/slicebox/slicebox');
require('../plugins/nice-select/js/jquery.nice-select');
require('../plugins/fresh-slider/slider');

require('../plugins/exzoom/jquery.exzoom');

// Own Scripts
require('./partials/theme');

import SweetAlert from './partials/sweet-alert';
Vue.use(SweetAlert);
// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

import vSelect from 'vue-select';
Vue.component('v-select', vSelect);

Vue.component('live-search', require('./components/LiveSearch').default);
Vue.component('shopping-cart', require('./components/ShoppingCart').default);
Vue.component('wishlist', require('./components/WishList').default);
Vue.component('quick-view', require('./components/QuickViewModal').default);
Vue.component('checkout', require('./components/Checkout').default);
Vue.component('edit-profile', require('./components/EditProfile').default);
Vue.component('franchise-register', require('./components/FranchiseRegister').default);
//Vue.component('circle-loader', CircleLoader);

import staticMethods from "./partials/staticMethods";

import store from './store/index';

const app = new Vue({
    el: '#app',
    store,
    data: {
        loading: false,
        quickViewProduct: {
            product: null,
            franchise: null
        },
        cartOpen: false,
        productView: {
            type: 'grid-view-3',
            column: 'col-sm-6 col-md-4'
        },
        productFranchise: null,
        productColor: null,
        productSize: null,
        productQuantity: 1,

        orderTrackNo: null
    },
    methods: {
        openQuickViewModal(id) {
            let self = this;
            self.toggleLoading();
            axios.get('/bs-client-api/product/quick-view/' + id)
                .then((response) => {
                    self.quickViewProduct = { product: null, franchise: null };
                    self.quickViewProduct = response.data;
                    window.setTimeout(function() {
                        self.toggleLoading();
                        $('#quickModal').modal({
                            backdrop: 'static',
                            keyboard: false
                        });
                        $("#productSingleExZoom").exzoom({
                            "autoPlay": true,
                            "autoPlayTimeout": 3500
                        });
                    }, 1000);
                })
                .catch((error) => {
                    this.$showErrorSwal({ title: 'Oops!', text: error.response.data.error });
                });
        },
        closeQuickViewModal() {
            this.quickViewProduct = { product: null, franchise: null };
            $('#quickModal').modal('hide');
        },
        toggleLoading() {
            if(this.loading === true) {
                this.loading = false;
                $('body').css('overflow', 'auto');
            }
            else {
                this.loading = true;
                $('body').css('overflow', 'hidden');
            }
        },
        addToCart(id) {
            let sizeEl = $('#sizeSelect');
            if(sizeEl.length > 0 && this.productSize === null) {
                this.$showErrorSwal({ title: 'Sorry!', text: 'Please Select a Size.' });
                return;
            }
            let colorEl = $('#colorSelect');
            if(colorEl.length > 0 && this.productColor === null) {
                this.$showErrorSwal({ title: 'Sorry!', text: 'Please Select a Color.' });
                return;
            }
            this.$store.dispatch('addToCart', { id: id, qty: this.productQuantity, size: this.productSize, color: this.productColor, franchise: this.productFranchise }).then(
                (response) => {
                    this.$showSuccessSwal({ title: 'Added!', text: 'Successfully Added to Cart.' });
                    this.clearProductForCart();
                    if(this.cartItemCount === 1 && !this.cartOpen) {
                        this.toggleCart();
                    }
                }, (error) => {
                    if(typeof error.data.franchise !== 'undefined') {
                        this.$showErrorModal({ title: 'OOPS!', text: error.data.franchise });
                    } else if(typeof error.data.status !== 'undefined') {
                        this.$showErrorSwal({ title: 'OOPS!', text: error.data.status });
                    } else {
                        this.$showErrorSwal({ title: 'OOPS!', text: 'Something Wrong! Please try again or refresh page.' });
                    }
                });
        },
        addToCartWithOption(options) {
            this.productQuantity = options.qty;
            this.productSize = options.size;
            this.productColor = options.color;
            this.productFranchise = options.franchise;
            this.addToCart(options.id);
        },
        clearProductForCart() {
            this.productQuantity = 1;
            this.productSize = null;
            this.productColor = null;
            this.productFranchise = null;
        },
        addToWishList(id) {
            if(this.user) {
                this.$store.dispatch('addToWishList', { pid: id })
                    .then((response) => {
                        this.$showSuccessSwal({ title: 'Added!', text: 'Successfully Added to Wishlist.' });
                        if(this.wishlist.length === 1) {
                            window.location.href = '/account#accountWishlist';
                        }
                    }, (error) => {
                        this.$showErrorSwal({ title: 'OOPS!', text: error });
                    });
            }
            else {
                this.$showErrorModal({ title: 'OOPS!', text: 'You must be logged in first!' });
            }
        },
        toggleCart() {
            this.cartOpen = !this.cartOpen;
        },
        changeAccountTab(event, id) {
            if(window.location.pathname.indexOf('account') > -1) {
                $(id + '-tab').tab('show');
                window.location.href = event.currentTarget.href;
            }
            else {
                window.location.href = event.currentTarget.href;
            }
        },
        submitFilterParam(name, value) {
            $('input[name=' + name + ']').val(value);
            $('#filterForm').submit();
        },
        toggleProductsView(type) {
            if(type !== this.productView.type) {
                if(type === 'list') {
                    this.productView.type = 'list-view';
                    this.productView.column = 'col-12';
                } else if(type === 'grid-view-3') {
                    this.productView.type = 'grid-view-3';
                    this.productView.column = 'col-sm-6 col-md-4';
                } else if(type === 'grid-view-4') {
                    this.productView.type = 'grid-view-4';
                    this.productView.column = 'col-sm-6 col-md-3';
                }
                $('button#' + type + '-btn')
                    .addClass('active')
                    .siblings().removeClass('active');
                axios.get('/bs-client-api/client-settings-cook/pView/' + type)
                    .then((response) => {}).catch((error) => {});
            }
        },
        trackOrder() {
            let order = $('input[name="order_no"]').val();
            order = order.replace('#', '');
            window.location.href = '/order/' + order;
        },
        openShareWindow(event) {
            event.preventDefault();
            console.log(document.title);
            let url = event.currentTarget.href;
            let w = (screen.width && screen.width > 768) ? 700 : 350;
            let h = (screen.height && screen.height > 768) ? 450 : 250;
            let LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
            let TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
            let settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable';
            let popupWindow = window.open(url, 'shareWindow', settings);
        }
    },
    computed: {
        cartItemCount() {
            return this.$store.getters.cartItemCount;
        },
        cartItemTotal() {
            return this.$store.getters.cartItemTotal;
        },
        cartWrapperHTML() {
            return this.cartItemCount + ' Items - <i class="sbicon sbicon-bdt"> </i> ' + this.cartItemTotal.toFixed(2);
        },
        user() {
            return (this.$store.state.user === null || typeof this.$store.state.user === 'undefined') ? false : this.$store.state.user;
        },
        wishlist() {
            return this.$store.state.wishlist;
        }
    },
    created() {
        this.$store.dispatch('initStore');
        $(document).ready(function () {
            $('#staticAddCartBtn').on('click', function(event) {
                //console.log(event.target);
            });
        });
        axios.get('/bs-client-api/client-settings-cook/pView')
            .then((response) => {
                if(response.data.pView !== null) {
                    this.toggleProductsView(response.data.pView);
                }
            }).catch((error) => { });

        const urlParams = new URLSearchParams(window.location.search);
        this.productFranchise = urlParams.get('fra');
    },
    mounted() {
        let self = this;
        self.$nextTick(function() {
            window.addEventListener('load', function(e) {
                staticMethods.resizeSidebar();
                window.setTimeout(function () {
                    staticMethods.resizeSidebar();
                }, 1000);
            });
        });
    }
});
