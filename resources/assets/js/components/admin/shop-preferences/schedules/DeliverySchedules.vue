<template>
    <div class="rbt-data-table delivery-schedules-data-table">
        <div class="card">
            <div class="card-header">
                <span v-html="topNav.header"></span>

                <a :href="topNav.link" class="pull-right" :title="topNav.title" v-html="topNav.text" @click.prevent="allSchedulesActive = !allSchedulesActive"></a>
            </div>
            <div class="card-body">
                <transition name="fade">
                    <div v-if="allSchedulesActive" class="delivery-schedules-data-table-content">
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
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="adminOrdersTable" width="100%">
                                <thead>
                                <tr class="text-center">
                                    <th class="">Expected Time Range</th>
                                    <th>Expected Hour Range</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <loading v-if="isLoading"></loading>

                                <tbody v-if="!isLoading">

                                <tr v-for="schedule in schedules.data">

                                    <td class="text-center">
                                        <span v-if="schedule.schedule_expected_time_from !== null && schedule.schedule_expected_time_to !== null">
                                            {{ ('2018-01-01 ' + schedule.schedule_expected_time_from) | moment("hh:mm A") }} - {{ ('2018-01-01 ' + schedule.schedule_expected_time_to) | moment("hh:mm A") }}
                                        </span>
                                        <span v-else>N/A</span>
                                    </td>

                                    <td class="text-center">
                                        <span v-if="schedule.schedule_expected_hour_from !== null && schedule.schedule_expected_hour_to !== null">
                                            {{ schedule.schedule_expected_hour_from + ' Hours - ' + schedule.schedule_expected_hour_to + ' Hours'}}
                                        </span>
                                        <span v-else>N/A</span>
                                    </td>

                                    <td class="text-center" style="min-width: 115px;">
                                        <a v-if="$root.adminType === 'super_admin' || $root.adminType === 'admin'" href="#view"
                                           @click.prevent="openViewModal(schedule.schedule_id)" class="btn btn-outline-info" title="View This Schedule">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a v-if="$root.adminType === 'super_admin' || $root.adminType === 'admin' || $root.adminType === 'manager'"
                                           href="#edit" @click.prevent="editSchedule(schedule)" class="btn btn-outline-warning" title="Edit This Schedule">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a v-if="$root.adminType === 'super_admin' || $root.adminType === 'admin'"
                                           @click.prevent="openDeleteModal(schedule.schedule_id)" class="btn btn-outline-danger" title="Delete This Schedule">
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
                                        Showing <strong>{{ schedules.from }} - {{ schedules.to }}</strong> of <strong>{{ schedules.total }}</strong>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="data-pagination">
                                        <pagination :data="schedules" @pagination-change-page="fetchData" :limit="1" class="pull-right">
                                            <span slot="prev-nav" title="Previous"><i class="fa fa-angle-double-left"></i></span>
                                            <span slot="next-nav" title="Next"><i class="fa fa-angle-double-right"></i></span>
                                        </pagination>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>
                <transition name="fade">
                    <div class="delivery-schedules-form" v-if="!allSchedulesActive">
                        <create-or-update-schedule :schedule_data="scheduleForEdit" @schedule-created="scheduleCreated" @schedule-updated="scheduleUpdated"></create-or-update-schedule>
                    </div>
                </transition>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="scheduleDeleteModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Schedule</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        Are you sure want to delete this delivery schedule..?
                    </div>
                    <div class="modal-footer">
                        <form @submit.prevent="deleteSchedule" method="post">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- View Modal -->
        <view-schedule :schedule_id="scheduleIdForView"></view-schedule>
    </div>
</template>


<script>
    import CreateOrUpdateDeliverySchedule from './CreateOrUpdateDeliverySchedule';
    import ViewSchedule from './ViewSchedule';

    export default {
        props: ['api_url'],
        components: { 'create-or-update-schedule': CreateOrUpdateDeliverySchedule, 'view-schedule': ViewSchedule },
        data() {
            return {
                isLoading: true,
                schedules: {},
                apiUrl: this.api_url,
                perPage: 15,
                deleteScheduleId: null,
                scheduleForEdit: undefined,
                scheduleIdForView: null,
                topNav: {
                    header: '<strong><i class="fa fa-clock-o"></i> Delivery</strong> Schedules',
                    title: 'Add New Delivery Schedule',
                    text: '<i class="fa fa-plus"></i> Add',
                    link: '#add'
                },
                allSchedulesActive: true
            }
        },
        created() {
            this.fetchData();
        },
        methods: {
            fetchData(page = 1) {
                let self = this;
                self.isLoading = false;

                axios.get(`${self.apiUrl}?page=${page}&per_page=${self.perPage}`)
                    .then(function (response) {
                        self.schedules = response.data;
                    })
                    .catch(function (error) {

                    });
            },
            editSchedule(schedule) {
                this.scheduleForEdit = schedule;
                this.allSchedulesActive = false;
            },
            scheduleCreated() {
                this.showToastMsg('Schedule Created Successfully..!', 'success', 3500);
                this.allSchedulesActive = true;
                this.fetchData();
            },
            scheduleUpdated() {
                this.showToastMsg('Schedule Updated Successfully..!', 'success', 3500);
                this.allSchedulesActive = true;
                this.fetchData();
            },
            openViewModal(id) {
                this.scheduleIdForView = id;
                $('#scheduleViewModal').modal('show');
            },
            openDeleteModal(id) {
                this.deleteScheduleId = id;
                $('#scheduleDeleteModal').modal('show');
            },
            deleteSchedule() {
                axios.delete(this.apiUrl + '/delete/' + this.deleteScheduleId)
                    .then((response) => {
                        this.showToastMsg('Schedule deleted successfully...!', 'success', 3000);
                        $('#scheduleDeleteModal').modal('hide');
                        this.deleteScheduleId = null;
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
        },
        watch: {
            'perPage': function(n, o) {
                this.fetchData();
            },
            'allSchedulesActive': function(value) {
                if(value) {
                    this.topNav.header = '<strong><i class="fa fa-clock-o"></i> Delivery</strong> Schedules';
                    this.topNav.title = 'Add New Delivery Schedule';
                    this.topNav.text = '<i class="fa fa-plus"></i> Add';
                    this.topNav.link = '#add';
                    this.scheduleForEdit = undefined;
                }
                else {
                    this.topNav.header = '<strong><i class="fa fa-plus"></i> Add New</strong> Schedule';
                    this.topNav.title = 'All Delivery Schedules';
                    this.topNav.text = '<i class="fa fa-clock-o"></i> All';
                    this.topNav.link = '';
                }
            }
        },
    }
</script>