<template>
    <div class="rbt-data-table product-data-table">
        <div class="card">
            <div class="card-header">
                <strong>All</strong> Products
            </div>
            <div class="card-body">

                <div class="data-table-header">
                    <div class="row justify-content-between">
                        <div class="col-sm-4 d-none d-sm-block">
                            <div class="data-per-page">
                                <label>
                                    Show
                                    <select v-model="perPage" class="form-control">
                                        <option value="15">15</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </label>
                            </div>
                        </div>

                        <div class="col-sm-8">
                            <div class="form-group data-search pull-right px-0">
                                <label class="sr-only" for="Search">Search</label>
                                <div class="input-group">
                                    <input v-model="search" @keyup="fetchData" type="text" class="form-control" id="Search" placeholder="Search by SKU or Title">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fa fa-search"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="adminOrdersTable" width="100%">
                        <thead>
                        <tr class="text-center">
                            <th>SKU</th>
                            <th class="d-none d-lg-table-cell">Image</th>
                            <th>Name</th>
                            <th>Cost</th>
                            <th>MRP</th>
                            <th>Categories</th>
                            <th>Stock Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <loading v-if="isLoading"></loading>

                        <tbody v-if="!isLoading">

                        <tr v-for="product in products.data">
                            <td class="text-center font-weight-bold">
                                <a :href="'/bs-admin/shop/products/show/' + product.product_sku" title="View Product" class="product-id">{{ product.product_sku }}</a>
                            </td>

                            <td class="d-none d-lg-table-cell text-center"  style="width: 120px;">
                                <img src="/assets/images/icon_bw.png" :alt="product.product_title" v-if="product.product_img_main === '' || product.product_img_main === null">

                                <img :src="'/uploads/public/cache/80/' + product.product_img_main" :alt="product.product_title" v-else>
                            </td>

                            <td>
                                <a :href="'/bs-admin/shop/products/show/' + product.product_sku" title="View Product" class="product-title">{{ product.product_title }}</a>
                            </td>

                            <td class="text-center">
                                <span v-if="$root.adminType !== 'shipper' && $root.adminType !== 'customer_manager' && $root.adminType !== 'franchise'">
                                    {{ product.product_unit_cost }}
                                </span>
                                <span v-else-if="$root.adminType === 'franchise'">
                                    {{ product.product_unit_mrp_franchise }}
                                </span>
                                <span v-else>
                                    N/A
                                </span>
                            </td>

                            <td class="text-center">
                                {{ product.product_unit_mrp }}
                            </td>

                            <td class="text-center" style="width: 200px;">
                                <span v-for="category in categories" v-if="category.product_id === product.product_id">
                                    {{ category.category_title }}
                                </span>
                            </td>

                            <td class="text-capitalize text-center">
                                <span v-if="$root.adminType === 'franchise' && typeof product.pivot !== 'undefined'">
                                    {{ product.pivot.fs_stock }}
                                </span>
                                <span v-else>
                                    {{ product.product_availability_status }} {{ (product.product_units_in_stock === null || product.product_units_in_stock === '') ? '' : '(' + product.product_units_in_stock + ')' }}
                                </span>
                            </td>

                            <td class="text-center" style="min-width: 115px;">
                                <a v-if="$root.adminType !== 'shipper'" :href="'/bs-admin/shop/products/show/' + product.product_sku" class="btn btn-outline-info" title="View This Product">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a v-if="$root.adminType !== 'shipper' && $root.adminType !== 'customer_manager' && $root.adminType !== 'franchise'" :href="'/bs-admin/shop/products/edit/' + product.product_id" class="btn btn-outline-warning" title="Edit This Product">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a v-if="$root.adminType === 'super_admin' || $root.adminType === 'admin'" @click.prevent="openDeleteModal(product.product_id)" href="#" class="btn btn-outline-danger" title="Delete This Product">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <a v-if="$root.adminType === 'franchise' && (typeof franchiseOwn !== 'undefined' || franchiseOwn !== true)" href="#" class="btn btn-outline-info" @click.prevent="showAddCart(product)" title="Add To Cart">
                                    <i class="fa fa-shopping-cart"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="data-table-footer">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="data-showing">
                                Showing <strong>{{ products.from }} - {{ products.to }}</strong> of <strong>{{ products.total }}</strong>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="data-pagination">
                                <pagination :data="products" @pagination-change-page="fetchData" :limit="1" class="pull-right">
                                    <span slot="prev-nav" title="Previous"><i class="fa fa-angle-double-left"></i></span>
                                    <span slot="next-nav" title="Next"><i class="fa fa-angle-double-right"></i></span>
                                </pagination>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Delete Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="productDeleteModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        Are you sure want to delete this product..?
                    </div>
                    <div class="modal-footer">
                        <form @submit.prevent="deleteProduct" method="post">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Cart Modal -->
        <div class="modal fade" id="addToCartModal" tabindex="-1" role="dialog" aria-labelledby="addToCartModalTitle" aria-hidden="true" v-if="productToAdd !== null">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form @submit.prevent="addToCart">
                        <div class="modal-header">
                            <h5 class="modal-title w-100 text-center" id="addToCartModalTitle">Add To Cart</h5>
                            <button type="button" class="close" @click.prevent="closeAddToCartModal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="units">Units</label>
                                <input type="number" id="units" class="form-control" :min="productToAdd.product_units_min_franchise" max="100" name="units"
                                       v-model="cartProduct.qty" required>
                            </div>

                            <div class="form-group" v-if="productToAdd.product_available_colors !== null">
                                <label for="color">Color</label>
                                <select class="custom-select" id="color" v-model="cartProduct.color" required>
                                    <option :value="null">Select Color</option>
                                    <option v-for="color in productToAdd.product_available_colors" :value="color">{{ color }}</option>
                                </select>
                            </div>

                            <div class="form-group" v-if="productToAdd.product_available_sizes !== null">
                                <label for="size">Size</label>
                                <select class="custom-select" id="size" v-model="cartProduct.size" required>
                                    <option :value="null">Select Size</option>
                                    <option v-for="size in productToAdd.product_available_sizes" :value="size">{{ size }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"  @click.prevent="closeAddToCartModal">Close</button>
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['api_url', 'product_type', 'franchiseOwn'],
        data() {
            return {
                isLoading: true,
                products: {},
                categories: [],
                apiUrl: this.api_url,
                perPage: 15,
                search: '',
                productDeleteId: null,

                productToAdd: null,
                cartProduct: {
                    id: null,
                    qty: null,
                    size: null,
                    color: null
                }
            }
        },
        mounted() {
            this.fetchData();
        },
        watch: {
            perPage(n, o) {
                this.fetchData();
            }
        },
        methods: {
            fetchData(page = 1) {
                let self = this;
                self.isLoading = false;

                axios.get(`${self.apiUrl}?page=${page}&per_page=${self.perPage}&search=${self.search}`)
                    .then(function (response) {

                        self.products = response.data.products;
                        self.categories = response.data.categories;
                    })
                    .catch(function (error) {

                    });
            },
            openDeleteModal(id) {
                this.productDeleteId = id;
                $('#productDeleteModal').modal('show');
            },
            deleteProduct() {
                axios.delete('/bs-admin-api/products/delete/' + this.productDeleteId)
                    .then((response) => {
                        this.showToastMsg('Product deleted successfully...!', 'success', 3000);
                        $('#productDeleteModal').modal('hide');
                        this.fetchData();
                    })
                    .catch((error) => {
                        this.showToastMsg('Something went wrong...! Try again later.', 'error', 5000);
                    });
            },
            showAddCart(product) {
                this.productToAdd = product;
                this.cartProduct.id = product.product_id;
                this.cartProduct.qty = product.product_units_min_franchise;
                let self = this;
                window.setTimeout(function () {
                    $('#addToCartModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                }, 500);
            },
            closeAddToCartModal() {
                this.cartProduct = { id: null, qty: null, size: null, color: null };
                this.productToAdd = null;
                $('#addToCartModal').modal('hide');
            },
            addToCart() {
                this.$store.dispatch('addToCart', this.cartProduct).then(
                    (response) => {
                        this.showToastMsg('Successfully Added to Cart.');
                    }, (error) => {
                        if(typeof error.data.status !== 'undefined') {
                            this.showToastMsg(error.data.status, 'error');
                        } else {
                            this.showToastMsg('Something Wrong! Please try again or refresh page.', 'error');
                        }
                    });
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
        }
    }
</script>
