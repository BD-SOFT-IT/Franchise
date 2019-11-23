import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    strict: process.env.NODE_ENV !== 'production',
    state: {
        //products: [], //{id, title, slug, image}
        cart: {
            products: [],
            vat: 0,
            shipping: {
                id: null,
                name: null,
                charge: 0.00,
                outside: false,
                time: null,
                note: null
            }
        },
        shippingMethods: []
    },

    getters: {
        cartItems: (state) => {
            return state.cart.products;
        },
        cartItemCount: (state, getters) => {
            return getters.cartItems.length;
        },
        existInCart: (state, getters) => (params) => {
            let product = getters.cartItems.find(function(item) {
                return (parseInt(item.id) ===  parseInt(params.id) && item.size === params.size && item.color === params.color);
            });
            return product ? product : false;
        },
        cartItemTotal: (state, getters) => {
            let total = 0.00;
            getters.cartItems.forEach(function (product) {
                total += (product.qty * product.price);
            });
            return total;
        },
        cartTotal: (state, getters) => {
            return (getters.cartItemTotal).toFixed(2);
        }
    },

    actions: {
        initStore({ state, getters, dispatch }) {
            return new Promise((resolve, reject) => {
                dispatch('getCartProducts').then((response) => {},
                    (error) => {
                        reject(error);
                    });

                /*dispatch('getShippingMethods').then((response) => {},
                    (error) => {
                        reject(error);
                    });*/
            });
        },
        // Add Product to Cart
        addToCart({ getters, dispatch, commit }, params) {
            return new Promise((resolve, reject) => {
                let product = {};
                product.id = params.id;
                product.qty = params.qty;
                if(params.uid) {
                    product.uid =  params.uid;
                } else {
                    let exists = getters.existInCart(params);
                    if(exists !== false) {
                        product.uid =  exists.uid;
                    } else {
                        if(params.size) {
                            product.size =  params.size;
                        }
                        if(params.color) {
                            product.color =  params.color;
                        }
                    }
                }
                axios.post('/bs-admin-api/cart/add', product)
                    .then((response) => {
                        if(typeof response.data.status !== 'undefined' && response.data.status === 'success') {
                            dispatch('getCartProducts').then((res) => {
                                resolve(res);
                            }, (err) => {
                                reject(err.response);
                            });
                        }
                    })
                    .catch((error) => {
                        //console.log(error.response);
                        return reject(error.response);
                    });
            });
        },
        // remove Product from Cart
        removeProduct({ dispatch, commit }, params) {
            return new Promise((resolve, reject) => {
                axios.post('/bs-admin-api/cart/delete', params)
                    .then((response) => {
                        if(typeof response.data.status !== 'undefined' && response.data.status === 'success') {
                            dispatch('getCartProducts').then((res) => {
                                return resolve(response.data.status);
                            }, (err) => {
                                return reject(err.response);
                            });
                        }
                    })
                    .catch((error) => {
                        //console.log(error.response);
                        return reject(error.response);
                    });
            });
        },
        // Get Cart Products
        getCartProducts({ commit }) {
            return new Promise((resolve, reject) => {
                axios.get('/bs-admin-api/cart')
                    .then((response) => {
                        commit('SET_CART_PRODUCTS', { products: response.data.products });
                        resolve(response.data.products);
                    })
                    .catch((error) => {
                        reject(error.response);
                    });
            });
        },

        placeOrder({ state, commit }, params) {
            return new Promise((resolve, reject) => {
                axios.post('/bs-admin-api/place-order', params).then((response) => {
                    resolve(response);
                }).catch((error) => {
                    reject(error.response);
                });
            });
        }
    },

    mutations: {
        SET_CART_PRODUCTS(state, payload) {
            state.cart.products = (typeof payload.products !== 'undefined' && payload.products.length > 0) ? payload.products : [];
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
