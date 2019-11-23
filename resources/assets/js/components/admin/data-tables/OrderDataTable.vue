<template>
    <div class="rbt-data-table order-data-table">
        <div class="card">
            <div class="card-header">
                <strong>{{ order_type }}</strong> Orders
            </div>
            <div class="card-body">

                <div class="data-table-header">
                    <div class="row">
                        <div class="col-sm-6 d-none d-sm-block">
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

                        <div class="col-sm-6">
                            <div class="data-search pull-right px-0">
                                <label class="sr-only" for="Search">Search</label>
                                <div class="input-group">
                                    <input v-model="search" @keyup="fetchData" type="text" class="form-control" id="Search" placeholder="Search here">
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
                            <th>ID</th>
                            <th class="d-none d-lg-table-cell">Customer</th>
                            <th class="d-none d-xl-table-cell">Payment</th>
                            <th class="d-none d-lg-table-cell">Value</th>
                            <th>Progress</th>
                            <th>Submitted</th>
                        </tr>
                        </thead>

                        <loading v-if="isLoading"></loading>

                        <tbody v-if="!isLoading">

                        <tr v-for="data in tableData.data">
                            <td class="text-center">
                                <a :href="'/bs-admin/shop/view-order/' + data.order_no" title="View Order" class="order-id">{{ data.order_no }}</a>
                            </td>

                            <td class="d-none d-lg-table-cell text-capitalize">
                                <a :href="'/bs-admin/shop/customers/details/' + data.order_client_id" class="order-client" title="View Customer">{{ data.first_name + ' ' + data.last_name }}</a>
                            </td>

                            <td class="d-none d-xl-table-cell">{{ data.order_payment_type }}</td>

                            <td class="d-none d-lg-table-cell">
                                <i class="sbicon sbicon-bdt"></i> {{ data.order_total }}
                            </td>

                            <td class="text-capitalize text-center">
                                <span :class="setProgressColor(data.order_progress)" class="order-progress">{{ data.order_progress }}</span>
                            </td>

                            <td class="text-center">
                                <span class="d-none d-sm-block">{{ data.created_at | moment("DD/MM/YYYY, hh:mm:ss A") }}</span>
                                <span class="d-block d-sm-none">{{ data.created_at | moment("DD/MM/YYYY") }}</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="data-table-footer">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="data-showing">
                                Showing <strong>{{ tableData.from }} - {{ tableData.to }}</strong> of <strong>{{ tableData.total }}</strong>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="data-pagination">
                                <pagination :data="tableData" @pagination-change-page="fetchData" :limit="1" class="pull-right">
                                    <span slot="prev-nav" title="Previous"><i class="fa fa-angle-double-left"></i></span>
                                    <span slot="next-nav" title="Next"><i class="fa fa-angle-double-right"></i></span>
                                </pagination>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['api_url', 'order_type'],
        data() {
            return {
                isLoading: true,
                tableData: { },
                apiUrl: this.api_url,
                perPage: 15,
                search: ''
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
                axios.get(`${self.apiUrl}?page=${page}&search=${self.search}&per_page=${self.perPage}`)
                    .then(function (response) {
                        self.tableData = response.data;

                    })
                    .catch(function (error) {
                        console.log(error.response);
                    });
            },
            setProgressColor(progress) {
                progress = progress.toLowerCase();
                let pClass = 'bg-warning text-black';

                if(progress === 'pending') {
                    pClass = 'bg-warning text-black';
                }
                else if(progress === 'processing') {
                    pClass = 'bg-primary text-white';
                }
                else if(progress === 'on delivery') {
                    pClass = 'bg-info text-white';
                }
                else if(progress === 'delivered') {
                    pClass = 'bg-success text-white';
                }
                else if(progress === 'canceled') {
                    pClass = 'bg-danger text-white';
                }

                return pClass;
            }
        }
    }
</script>
