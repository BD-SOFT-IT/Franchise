<template>
    <div class="rbt-data-table product-brand-data-table">
        <div class="card">
            <div class="card-header">
                <strong><i class="fa fa-handshake-o"></i> All</strong> Franchise
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
                            <div class="data-search pull-right">
                                <label class="sr-only" for="Search">Search</label>
                                <div class="input-group">
                                    <input v-model="search" @keyup="fetchData" type="text" class="form-control" id="Search" placeholder="Search Here">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fa fa-search"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="FranchiseTable" style="width: 100%;">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                        </thead>

                        <loading v-if="isLoading"></loading>

                        <tbody v-if="!isLoading">

                            <tr v-for="franchise in franchises.data">

                                <th scope="row">{{ franchise.name }}</th>
                                <td>{{ franchise.email }}</td>
                                <td>{{ franchise.mobile_primary }}</td>
                                <td>
                                    <span class="text-success" v-if="franchise.active">
                                        Active
                                    </span>
                                    <span class="text-danger" v-else>
                                        Inactive
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a :href="'/bs-admin/shop/franchise-control/show/' + franchise.id" class="btn btn-outline-info" title="View"><i class="fa fa-eye"></i></a>
                                    <a :href="'/bs-admin/shop/franchise-control/edit/' + franchise.id" class="btn btn-outline-warning" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a href="#" v-if="$root.adminType === 'super_admin' || $root.adminType === 'admin'" @click.prevent="openDeleteModal(franchise.id)" class="btn btn-outline-danger" title="Delete">
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
                                Showing <strong>{{ franchises.from }} - {{ franchises.to }}</strong> of <strong>{{ franchises.total }}</strong>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="data-pagination">
                                <pagination :data="franchises" @pagination-change-page="fetchData" :limit="1" class="pull-right">
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
        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="franchiseDeleteModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Franchise</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        Are you sure want to delete this Franchise..?
                    </div>
                    <div class="modal-footer">
                        <form @submit.prevent="deleteFranchise" method="post">
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
                franchises: {},
                apiUrl: this.api_url,
                perPage: 15,
                search: '',
                viewFranchise: {},
                deleteFranchiseId: ''
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
                        self.franchises = response.data;
                    })
                    .catch(function (error) {
                        console.log(error.response);
                    });
            },
            openDeleteModal(id) {
                this.deleteFranchiseId = id;
                $('#franchiseDeleteModal').modal('show');
            },
            deleteFranchise() {
                axios.delete('/bs-admin-api/franchise-control/delete/' + this.deleteFranchiseId)
                    .then((response) => {
                        this.showToastMsg('Franchise deleted successfully...!', 'success', 3000);
                        $('#franchiseDeleteModal').modal('hide');
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
