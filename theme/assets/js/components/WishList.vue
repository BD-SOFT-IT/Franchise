<template>
    <div class="table-responsive wishlist-table">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col" class="d-none d-md-table-cell">Stock Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="(product, key) in products">
                    <th scope="row">{{ key + 1 }}</th>
                    <td>
                        <a :href="product.slug" class="hvr-buzz-out" v-tooltip.top-center="'Click to View Details'">
                            <img :src="product.image" :alt="product.title">
                        </a>
                    </td>
                    <td>
                        <a :href="product.slug" v-tooltip.top-center="'Click to View Details'">
                            <strong>{{ product.title }}</strong>
                        </a>
                    </td>
                    <td>
                        <i class="sbicon sbicon-bdt"></i> {{ product.current_price }}
                        <span class="old-price" v-if="product.old_price !== null">
                            <i class="sbicon sbicon-bdt"></i> {{ product.old_price }}
                        </span>
                    </td>
                    <td class="d-none d-md-table-cell">{{ product.status }}</td>
                    <td>
                        <button class="btn btn-light" @click="addToCart(product.id, key)">
                            <i class="icon ion-md-cart"></i> Add to Cart
                        </button>
                        <br>
                        <button class="btn btn-danger" @click="remove(product.id, key)">
                            <i class="icon ion-md-trash"></i> Remove
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: [],
        data() {
            return {

            }
        },
        methods: {
            remove(pid, index) {
                this.$store.dispatch('removeFromWishlist', { pid: pid }).then(
                    (response) => {

                    },
                    (error) => {
                        this.$showErrorSwal({ title: 'OOPS!', text: 'Something Wrong! Please try again or refresh page.' });
                    }
                );
            },
            addToCart(pid, index) {
                this.$store.dispatch('addToCart', { id: pid, qty: 1 }).then(
                    (response) => {
                        this.$showSuccessSwal({ title: 'Added!', text: 'Successfully Added to Cart.' });
                        this.remove(pid, index);
                    }, (error) => {
                        //console.log(error.response);
                        this.$showErrorSwal({ title: 'OOPS!', text: 'Something Wrong! Please try again or refresh page.' });
                    });
            },
        },
        computed: {
            products() {
                return this.$store.state.wishlist;
            }
        }
    };
</script>
