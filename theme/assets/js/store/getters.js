const getters = {
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
    couponDiscount: (state, getters) => {
        if(!state.cart.coupon.code) {
            return 0.00;
        }
        if(state.cart.coupon.amount !== null && state.cart.coupon.amount > 0) {
            return state.cart.coupon.amount.toFixed(2);
        }
        let amount = (getters.cartItemTotal * (state.cart.coupon.percentage / 100));

        return (amount > state.cart.coupon.max) ? state.cart.coupon.max.toFixed(2) : amount.toFixed(2);
    },
    cartTotal: (state, getters) => {
        return (getters.cartItemTotal - getters.couponDiscount + state.cart.shipping.charge).toFixed(2);
    }
};

export default getters;
