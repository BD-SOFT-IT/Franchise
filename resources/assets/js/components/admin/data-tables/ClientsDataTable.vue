<template>
    <div>
        <div>
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
                                <input v-model="search" type="text" class="form-control" id="Search" placeholder="Search by Name or Email or Mobile">
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
                        <th scope="col" class="text-center">Image</th>
                        <th scope="col" class="text-center">Name</th>
                        <th scope="col" class="text-center">Email</th>
                        <th scope="col" class="text-center">Mobile</th>
                        <th scope="col" class="text-center">Blood Group</th>
                        <th scope="col" class="text-center">Total Orders</th>
                        <th scope="col" class="text-center">Status</th>
                    </tr>
                    </thead>

                    <loading v-if="isLoading"></loading>

                    <tbody v-if="!isLoading">

                    <tr v-for="(franchise, index) in franchises.data">

                        <th class="text-center" style="width: 100px;">
                            <a :href="'/bs-admin/shop/customers/details/' + franchise.id" title="Click to View Details">
                                <img :src="franchise.image" :alt="franchise.name" style="max-height: 55px; max-width: 55px; margin: 0 auto;">
                            </a>
                        </th>
                        <td class="font-weight-bold text-center" title="Click to View Details">
                            <a :href="'/bs-admin/shop/customers/details/' + franchise.id">{{ franchise.name }}</a>
                        </td>
                        <td class="text-center">{{ franchise.email }}</td>
                        <td class="text-center">{{ franchise.mobile }}</td>
                        <td class="text-center">{{ franchise.blood_group }}</td>
                        <td class="text-center">{{ franchise.total_orders }}</td>
                        <td class="text-center">
                                    <span class="text-success" v-if="franchise.active">
                                        Active
                                    </span>
                            <span class="text-danger" v-else>
                                        Inactive
                                    </span>
                            <a href="#" v-if="$root.adminType === 'super_admin' || $root.adminType === 'admin'" @click.prevent="openStatusModal(franchise, index)" class="btn btn-link text-warning" title="Change">
                                <i class="fa fa-pencil"></i>
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
                            <pagination :show-disabled="true" :data="franchises" @pagination-change-page="fetchData" :limit="1" class="pull-right">
                                <span slot="prev-nav" title="Previous"><i class="fa fa-angle-double-left"></i></span>
                                <span slot="next-nav" title="Next"><i class="fa fa-angle-double-right"></i></span>
                            </pagination>
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
                        <h5 class="modal-title text-center w-100" v-text="modalHeader"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center py-5" v-html="modalText">

                    </div>
                    <div class="modal-footer">
                        <form @submit.prevent="changeStatus" method="post">
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
        props: ['apiUrl'],
        data() {
            return {
                isLoading: true,
                franchises: {},
                perPage: 15,
                search: '',
                searchData: '',
                viewFranchise: {},
                clientForChange: {
                    id: '',
                    index: ''
                },
                modalText: 'Are you sure want to change the status of this customer..?',
                modalHeader: 'Deactivate'
            }
        },
        created() {
            this.fetchData();
        },
        watch: {
            perPage(value) {
                this.fetchData();
            },
            search(value) {
                if(value.charAt(0) === '0' && !isNaN(value.substr(0, 2))) {
                    this.searchData = value.substr(1);
                } else {
                    this.searchData = value;
                }
                this.fetchData();
            }
        },
        methods: {
            fetchData(page = 1) {
                let self = this;
                self.isLoading = false;
                axios.get(`${self.apiUrl}?page=${page}&per_page=${self.perPage}&search=${self.searchData}`)
                    .then(function (response) {
                        self.franchises = response.data;
                    })
                    .catch(function (error) {
                        console.log(error.response);
                    });
            },
            openStatusModal(client, index) {
                this.clientForChange.id = client.id;
                this.clientForChange.index = index;
                if(client.active) {
                    this.modalHeader = 'Deactivate Customer\'s Account';
                    this.modalText = 'Are you sure want to deactivate <strong>"' + client.name + '"</strong>?' +
                        '<br><br>If so, then the customer won\'t be able to login further.';
                } else {
                    this.modalHeader = 'Activate Customer\'s Account';
                    this.modalText = 'Are you sure want to activate <strong>"' + client.name + '"</strong>?';
                }
                $('#franchiseDeleteModal').modal('show');
            },
            changeStatus() {
                axios.patch('/bs-admin-api/customers/change/' + this.clientForChange.id)
                    .then((response) => {
                        this.showToastMsg('Changed successfully...!', 'success', 3000);
                        let index = parseInt(this.clientForChange.index);
                        this.franchises.data[index].active = !this.franchises.data[index].active;
                        $('#franchiseDeleteModal').modal('hide');
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
