import root from 'window-or-global';
require('./bootstrap');
//
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    root.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found.');
}

root.Vue = require('vue');
Vue.config.productionTip = false;
import VueDisabled from 'vue-disabled';
Vue.use(VueDisabled);

import VueProgressiveImage from 'vue-progressive-image';
Vue.use(VueProgressiveImage, {
    placeholder: '/assets/images/loading.gif'
});

import VueMoment from 'vue-moment';
Vue.use(VueMoment);

import VeeValidate from './vee-validate';
Vue.use(VeeValidate, {
    classes: true,
    classNames: {
        valid: 'is-valid',
        invalid: 'is-invalid'
    }
});
/*import { Validator } from 'vee-validate';
import AdminValidationDictionary from './admin-validation-dictionary';
Validator.localize(AdminValidationDictionary);*/

import VueCookies from 'vue-cookies';
Vue.use(VueCookies);
// Text Editor
import wysiwyg from "vue-wysiwyg";
Vue.use(wysiwyg, {
    hideModules: {
        'code': true,
        'image': true,
        'table': true,
        'removeFormat': true,
        'separator': true
    },
    maxHeight: "400px"
});

import { Printd } from 'printd';
// Toggle Button
import ToggleButton from 'vue-js-toggle-button';
Vue.use(ToggleButton);

import Toasted from 'vue-toasted';
Vue.use(Toasted, {
    position: 'bottom-right',
    duration: 2500,
    className: 'rbt-toast',
    containerClass: 'rbt-toast-container',
    iconPack: 'fontawesome',
});

import resize from 'vue-resize-directive';

/* All Admin Vue Components */
Vue.component('pagination', require('laravel-vue-pagination'));

Vue.component('rbt-media-manager', require('./rbt-media-manager/RbtMediaManager').default);
Vue.component('loading', require('./components/common/Loading').default);
Vue.component('theme-color-picker', require('./components/admin/partials/ThemeColorPicker').default);
// Notifications Components
Vue.component('header-nav-mail', require('./components/admin/partials/HeaderNavMail').default);
Vue.component('header-nav-notifications', require('./components/admin/partials/HeaderNavNotifications').default);
Vue.component('header-nav-task', require('./components/admin/partials/HeaderNavTask').default);
// Category Components
Vue.component('new-category', require('./components/admin/categories/NewCategory').default);
// Product Components
Vue.component('create-product', require('./components/admin/products/CreateProduct').default);
// Product Components
Vue.component('create-shipper', require('./components/admin/shipper/CreateShipper').default);
// Order Components
Vue.component('create-order', require('./components/admin/orders/CreateOrder').default);
// Brand Components
Vue.component('create-product-brand', require('./components/admin/products/CreateProductBrand').default);
// Shop Preferences Components
Vue.component('delivery-locations', require('./components/admin/shop-preferences/locations/DeliveryLocations').default);
Vue.component('delivery-schedules', require('./components/admin/shop-preferences/schedules/DeliverySchedules').default);
// Ads Components
Vue.component('category-banner', require('./components/admin/ads/CategoryBanners').default);
Vue.component('promotional-banner', require('./components/admin/ads/PromotionalBanner').default);
// Data Table Components
Vue.component('order-data-table', require('./components/admin/data-tables/OrderDataTable').default);
Vue.component('print-bill', require('./components/common/PrintBill').default);
Vue.component('product-data-table', require('./components/admin/data-tables/ProductDataTable').default);
Vue.component('franchise-data-table', require('./components/admin/data-tables/FranchiseDataTable').default);
Vue.component('product-brand-data-table', require('./components/admin/data-tables/ProductBrandDataTable').default);
Vue.component('clients-data-table', require('./components/admin/data-tables/ClientsDataTable').default);

Vue.component('shopping-cart', require('./components/admin/franchise/ShoppingCart').default);
Vue.component('checkout', require('./components/admin/franchise/Checkout').default);

import store from './store';

const app = new Vue({
    el: '#rbtEMS',
    store,
    directives: {
        resize
    },
    data: {
        isLoading: false,
        windowWidth: 0,
        mainSidebarToggled: false,
        controlSidebarToggled: false,
        admin: {  },
        adminType: '',
    },
    created() {
        this.mainSidebarToggled = (this.$cookies.get('rbt_main_sidebar_toggled') === 'true');
    },
    methods: {
        mainSidebarPcToggler() {
            this.mainSidebarToggled = !this.mainSidebarToggled;

            this.$cookies.set('bs_main_sidebar_toggled', this.mainSidebarToggled, -1, '/bs-admin', window.location.hostname);
        },
        toggleControlSidebar() {
            this.controlSidebarToggled = !this.controlSidebarToggled;
        },
        onAdminContentResize() {
            let mainSidebar = this.$refs['mainSidebar'];
            let adminContent = this.$refs['adminContent'];

            if(adminContent.clientHeight < mainSidebar.clientHeight) {
                adminContent.style.minHeight = (mainSidebar.clientHeight - 50) + 'px';
            }
            else if(adminContent.clientHeight > mainSidebar.clientHeight) {
                mainSidebar.style.minHeight = (adminContent.clientHeight + 90) + 'px';
            }
        },
        getMyself() {
            axios.get('/bs-admin-api/admins/me')
                .then((response) => {
                    this.admin = response.data;
                    this.adminType = response.data.admin_role;
                })
                .catch((error) => { });
        },
        printBill() {
            const cssText = '#orderPrint { font-family: \'Open Sans\', sans-serif; width: 100%; position: relative; }' +
                'table { font-size: 80%; border-spacing: 0; border-collapse: collapse; } div { font-size: 80%; }' +
                '.logo { -webkit-print-color-adjust: exact; width: 160px !important; height: 160px !important; background-image: url("/images/logo_print.png") !important; ' +
                'background-repeat: no-repeat !important; background-position: center !important; background-size: contain !important; opacity: 0.85; }' +
                'table { width: 100%; } .header-table { opacity: 1; }' +
                '  td { padding: 2px 5px; }' +
                '  .sb-address { margin: 8px 0; font-weight: 600; }' +
                '  .invoice { vertical-align: top; text-align: right; font-weight: 600; text-transform: uppercase; font-size: 18px; }' +
                '  .info-table { margin: 18px 0; font-size: 12px; opacity: 1; }' +
                '  .info-table td { border: 1px dashed #b5b5b5; width: 25%; }' +
                '  .info-table .td-row { width: 30mm !important; }' +
                '  .products-table { width: 100%; opacity: 1; background-color: #fff; }' +
                '  .products-table td, .products-table th { border: 1px solid #909090; }' +
                '  .products-table th { text-align: center; }' +
                '  .products-table .product-title { font-size: 11px; }' +
                '  .products-table .product-title .bangla { font-family: "AdorshoLipi"; font-size: 9px; }' +
                '  .products-table .quantity { text-align: center; } .last-total { font-size: 12px; }' +
                '  .products-table .total-price, .products-table .unit-price, .products-table .td-row { text-align: right; }' +
                '  .products-table .td-row { border: 0 !important; } .footer { width: 100%; position: fixed; bottom: 0; z-index: -1; }' +
                '  .footer-thanks { text-align: center; font-weight: 600; font-size: 15px; margin: 15px 0 5px; }' +
                '  .footer-text { text-align: center; } .signature { border: 0 !important; } .signature span { font-size: 11px; } ';
            const d = new Printd();
            d.print(document.getElementById('orderPrint'), [ cssText ]);
        }
    },
    watch: {
        windowWidth: function (newWidth, oldWidth) {
            this.mainSidebarToggled = newWidth < 992 ? true : (this.$cookies.get('bs_main_sidebar_toggled') === 'true');
        }
    },
    mounted() {
        let self = this;
        this.windowWidth = window.innerWidth;
        this.onAdminContentResize();
        this.$nextTick(function() {
            window.addEventListener('resize', function(e) {
                self.windowWidth = window.innerWidth;
            });
        });
        this.getMyself();
        self.$store.dispatch('initStore');
    }
});
