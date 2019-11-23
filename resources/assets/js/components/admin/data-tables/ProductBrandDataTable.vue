<template>
    <div class="rbt-data-table product-brand-data-table">
        <div class="card">
            <div class="card-header">
                <strong><i class="fa fa-superpowers"></i> All</strong> Brands
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
                                    <input v-model="search" @keyup="fetchData" type="text" class="form-control" id="Search" placeholder="Search by Brand Name">
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
                            <th class="d-none d-lg-table-cell">Image</th>
                            <th>Name</th>
                            <th>Website</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <loading v-if="isLoading"></loading>

                        <tbody v-if="!isLoading">

                        <tr v-for="brand in brands.data">

                            <td class="d-none d-lg-table-cell text-center"  style="width: 120px;">
                                <img src="/assets/images/brand.png" :alt="brand.pb_name" v-if="brand.pb_img === '' || brand.pb_img === null">

                                <img :src="'/uploads/public/cache/small/' + brand.pb_img" :alt="brand.pb_name" v-else>
                            </td>

                            <td>
                                <a :href="'/bs-admin/shop/product-brands/show/' + brand.pb_id" title="View Brand" class="brand-title">{{ brand.pb_name }}</a>
                            </td>

                            <td class="text-center">
                                {{ brand.pb_website }}
                            </td>

                            <td class="text-center" style="min-width: 115px;">
                                <a v-if="$root.adminType !== 'shipper'" :href="'/bs-admin/shop/product-brands/show/' + brand.pb_id" class="btn btn-outline-info" title="View This Brand">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a v-if="$root.adminType !== 'shipper' && $root.adminType !== 'customer_manager'" :href="'/bs-admin/shop/product-brands/edit/' + brand.pb_id" class="btn btn-outline-warning" title="Edit This Brand">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a v-if="$root.adminType === 'super_admin' || $root.adminType === 'admin'" @click.prevent="openDeleteModal(brand.pb_id)" class="btn btn-outline-danger" title="Delete This Brand">
                                    <i class="fa fa-trash"></i>
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
                                Showing <strong>{{ brands.from }} - {{ brands.to }}</strong> of <strong>{{ brands.total }}</strong>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="data-pagination">
                                <pagination :data="brands" @pagination-change-page="fetchData" :limit="1" class="pull-right">
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
        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="brandDeleteModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Brand</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        Are you sure want to delete this brand..?
                    </div>
                    <div class="modal-footer">
                        <form @submit.prevent="deleteBrand" method="post">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['api_url'],
        data() {
            return {
                isLoading: true,
                brands: {},
                apiUrl: this.api_url,
                perPage: 15,
                search: '',
                viewBrand: {},
                deleteBrandId: ''
            }
        },
        created() {
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
                        self.brands = response.data;
                    })
                    .catch(function (error) {

                    });
            },
            openDeleteModal(id) {
                this.deleteBrandId = id;
                $('#brandDeleteModal').modal('show');
            },
            deleteBrand() {
                axios.delete('/bs-admin-api/product-brands/delete/' + this.deleteBrandId)
                    .then((response) => {
                        this.showToastMsg('Brand deleted successfully...!', 'success', 3000);
                        $('#brandDeleteModal').modal('hide');
                        this.fetchData();
                    })
                    .catch((error) => {
                        this.showToastMsg('Something went wrong...! Try again later.', 'error', 5000);
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
