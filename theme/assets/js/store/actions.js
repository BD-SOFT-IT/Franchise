const actions = {
    // initStore on page load
    initStore({ state, getters, dispatch }) {
        return new Promise((resolve, reject) => {
            dispatch('getUser').then((response) => {},
                (error) => {
                    reject(error);
                });

            dispatch('getCartProducts').then((response) => {},
                (error) => {
                    reject(error);
                });

            dispatch('getShippingMethods').then((response) => {},
                (error) => {
                    reject(error);
                });

            dispatch('getClientData').then((response) => {
                    if(response.coupon !== null && response.coupon.length > 0) {
                        dispatch('validateCoupon', { coupon: response.coupon, total: getters.cartItemTotal });
                    }
                },
                (error) => {
                    reject(error);
                });

            dispatch('getWishlist').then((response) => {},
                (error) => {
                    reject(error);
                });
        });
    },
    //get User's Data
    getClientData({ commit }) {
        return new Promise((resolve, reject) => {
            axios.get('/bs-client-api/client-settings-cook')
                .then((response) => {
                    commit('SET_CLIENT_DATA', { data: response.data });
                    resolve(response.data);
                }).catch((error) => {
                    reject(error);
            });
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
            if(params.franchise) {
                product.fran =  params.franchise;
            }
            axios.post('/bs-client-api/cart/add', product)
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
            axios.post('/bs-client-api/cart/delete', params)
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
            axios.get('/bs-client-api/cart')
                .then((response) => {
                    commit('SET_CART_PRODUCTS', { products: response.data.products });
                    resolve(response.data.products);
                })
                .catch((error) => {
                    reject(error.response);
                });
        });
    },
    // Get User
    getUser({ commit }) {
        return new Promise((resolve, reject) => {
            axios.get('/bs-client-api/user')
                .then((response) => {
                    if(response.data !== 'Unauthenticated') {
                        commit('SET_USER', { user: response.data });
                        resolve(true);
                    }
                })
                .catch((error) => {
                    //console.log(error.response);
                    reject(error.response);
                });
        });
    },
    //get Wishlist
    getWishlist({ state, commit }) {
        return new Promise((resolve, reject) => {
            let n = 1;
            let intVal = window.setInterval(function () {
                if(typeof state.user !== 'undefined' && state.user !== null) {
                    axios.get('/bs-client-api/wishlist')
                        .then((response) => {
                            commit('SET_WISHLIST', { wishlist: response.data });
                            resolve(true);
                            clearInterval(intVal);
                        })
                        .catch((error) => {

                        });
                }
                else {
                    if(n > 4) {
                        clearInterval(intVal);
                    }
                    n++;
                }
            }, 1000);
        });
    },
    // add to wishlist
    addToWishList({ commit, dispatch }, params) {
        return new Promise((resolve, reject) => {
            axios.post('/bs-client-api/wishlist/add', { pid: params.pid })
                .then((response) => {
                    commit('ADD_WISHLIST', { wishlist: response.data });
                    resolve(true);
                })
                .catch((error) => {
                    reject(error.response.data);
                });
        });
    },
    //remove from wishlist
    removeFromWishlist({ commit }, params) {
        return new Promise((resolve, reject) => {
            axios.delete('/bs-client-api/wishlist/delete/' + params.pid)
                .then((response) => {
                    if(typeof response.data.status !== 'undefined') {
                        commit('SET_WISHLIST', { wishlist: response.data.wishlist });
                        resolve(true);
                    }
                })
                .catch((error) => {
                    //console.log(error.response);
                    reject(error.response);
                });
        });
    },
    // Validate Coupon
    validateCoupon({ state, getters, commit }, params) {
        return new Promise((resolve, reject) => {
            if(state.cart.coupon.code !== null && state.cart.coupon.code.toLowerCase() === params.coupon.toLowerCase()) {
                reject('Coupon is already applied to your cart!');
            }
            axios.post('/bs-client-api/validate-coupon', { coupon: params.coupon, total: getters.cartItemTotal })
                .then((response) => {
                    let coupon = {
                        code: response.data.code,
                        percentage: (response.data.percentage !== null) ? parseFloat(response.data.percentage) : null,
                        amount: (response.data.amount !== null) ? parseFloat(response.data.amount) : null,
                        max: (response.data.max !== null) ? parseFloat(response.data.max) : null
                    };
                    commit('SET_COUPON', { coupon: coupon });
                    resolve('Coupon Successfully Added!');
                })
                .catch((error) => {
                    console.log(error.response);
                    commit('SET_COUPON', { coupon: { code: null, percentage: null, amount: null, max: null } });
                    if(typeof error.response.data.error !== 'undefined') {
                        reject(error.response.data.error);
                    }
                    else {
                        reject('Something Wrong! Please try again or refresh page!');
                    }
                });
        });
    },

    getShippingMethods({ commit, dispatch }) {
        return new Promise((resolve, reject) => {
            axios.get('/bs-client-api/delivery-methods')
                .then((response) => {
                    commit('SET_SHIPPING_METHOD', { methods: response.data });
                    dispatch('addShippingMethod', { id: response.data[0].id });
                    resolve(true);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },

    addShippingMethod({ state, commit }, params) {
        if(!state.cart.shipping.id || state.cart.shipping.id !== params.id) {
            let method = state.shippingMethods.find(function(item) {
                return item.id === params.id;
            });
            commit('ADD_SHIPPING_METHOD', { method: method });
        }
    },
    placeOrder({ state, commit }, params) {
        return new Promise((resolve, reject) => {
            axios.post('bs-client-api/place-order', params).then((response) => {
                resolve(response);
            }).catch((error) => {
                reject(error.response);
            });
        });
    }
};

export default actions;
