import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import getters from "./getters";
import actions from "./actions";

export default new Vuex.Store({
    strict: process.env.NODE_ENV !== 'production',
    state: {
        //products: [], //{id, title, slug, image}
        wishlist: [],
        cart: {
            products: [],
            vat: 0,
            coupon: {
                code: null,
                percentage: null,
                amount: null,
                max: null
            },
            shipping: {
                id: null,
                name: null,
                charge: 0.00,
                outside: false,
                time: null,
                note: null
            }
        },
        clientData: {
            vendor: null,
            coupon: null,
            pView: null
        },
        shippingMethods: [],
        user: null
    },

    getters: getters,

    actions: actions,

    mutations: {
        SET_CART_PRODUCTS(state, payload) {
            state.cart.products = (typeof payload.products !== 'undefined' && payload.products.length > 0) ? payload.products : [];
        },
        SET_USER(state, payload) {
            state.user = payload.user;
        },
        ADD_WISHLIST(state, payload) {
            state.wishlist.push(payload.wishlist);
        },
        SET_WISHLIST(state, payload) {
            state.wishlist = payload.wishlist;
        },
        SET_COUPON(state, payload) {
            state.cart.coupon = payload.coupon
        },
        SET_CLIENT_DATA(state, payload) {
            state.clientData = payload.data;
        },
        SET_SHIPPING_METHOD(state, payload) {
            state.shippingMethods = payload.methods;
        },
        ADD_SHIPPING_METHOD(state, payload) {
            state.cart.shipping = payload.method;
        },
        ADD_PAYMENT_METHOD(state, payload) {

        }
    }
});
