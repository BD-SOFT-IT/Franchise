<template>
    <div class="modal animated bounceInUp" tabindex="-1" role="dialog" id="scheduleViewModal" aria-hidden="true" data-wow-duration="1s">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title w-100">View Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="font-size: 14px;" v-if="schedule_id !== null">
                    <loading v-if="loading"></loading>

                    <div class="table-responsive" v-else>
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr>
                                <th scope="row" style="width: 150px !important; vertical-align: middle;">Time Range</th>
                                <td class="text-center">
                                            <span v-if="schedule.schedule_expected_time_from !== null && schedule.schedule_expected_time_to !== null">
                                                {{ ('2018-01-01 ' + schedule.schedule_expected_time_from) | moment("hh:mm A") }} - {{ ('2018-01-01 ' + schedule.schedule_expected_time_to) | moment("hh:mm A") }}
                                            </span>
                                    <span v-else>N/A</span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 150px !important; vertical-align: middle;">Time Range (Bengali)</th>
                                <td class="text-center">
                                    <span v-if="schedule.schedule_time_range_bengali !== null">{{ schedule.schedule_time_range_bengali }}</span>
                                    <span v-else>N/A</span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 150px !important; vertical-align: middle;">Hour Range</th>
                                <td class="text-center">
                                            <span v-if="schedule.schedule_expected_hour_from !== null && schedule.schedule_expected_hour_to !== null">
                                                {{ schedule.schedule_expected_hour_from + ' Hours - ' + schedule.schedule_expected_hour_to + ' Hours'}}
                                            </span>
                                    <span v-else>N/A</span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 150px !important; vertical-align: middle;">Log</th>
                                <td class="text-capitalize">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">Content</th>
                                            <th scope="col">Author</th>
                                            <th scope="col">Time</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="log in schedule.schedule_log">
                                            <td style="width: 150px !important;">{{ log.content }}</td>
                                            <td style="width: 150px !important;">{{ log.author_name }}</td>
                                            <td style="width: 150px !important;">{{ log.time }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['schedule_id'],
        data() {
            return {
                loading: false,
                schedule: {}
            }
        },
        methods: {
            fetchData() {
                this.loading = true;
                axios.get(this.$parent.apiUrl + '/show/' + this.schedule_id)
                    .then((response) => {
                        console.log(this.$parent.apiUrl + '/show/' + this.schedule_id);
                        console.log(response);
                        this.schedule = response.data;
                        this.loading = false;
                    })
                    .catch((error) => {

                    });
            }
        },
        watch: {
            'schedule_id': function(val) {
                if(val !== null) {
                    this.fetchData();
                }
            }
        }
    }
</script>