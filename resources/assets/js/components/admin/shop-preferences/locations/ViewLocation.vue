<template>
    <div class="modal animated bounceInUp" id="viewLocationModal" tabindex="-1" role="dialog"
         aria-labelledby="viewLocationModalLabel" aria-hidden="true" data-wow-duration="1s">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title w-100" id="viewLocationModalLabel">Location Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body text-center" style="font-size: 14px;">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr>
                                <th scope="row" style="width: 150px !important; vertical-align: middle;">Name</th>
                                <td>{{ viewLocation.location_name }} - {{ viewLocation.location_name_bengali }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 150px !important; vertical-align: middle;">Type</th>
                                <td class="text-capitalize">{{ viewLocation.location_type }}</td>
                            </tr>
                            <tr v-if="viewLocation.location_city !== null">
                                <th scope="row" style="width: 150px !important; vertical-align: middle;">City</th>
                                <td>{{ viewLocation.location_city }}</td>
                            </tr>
                            <tr v-if="viewLocation.location_state !== null">
                                <th scope="row" style="width: 150px !important; vertical-align: middle;">State</th>
                                <td>{{ viewLocation.location_state }}</td>
                            </tr>
                            <tr v-if="viewLocation.location_country !== null">
                                <th scope="row" style="width: 150px !important; vertical-align: middle;">Country</th>
                                <td>{{ viewLocation.location_country }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 150px !important; vertical-align: middle;">Created By</th>
                                <td class="text-capitalize">{{ viewLocation.location_author }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 150px !important; vertical-align: middle;">Schedules</th>
                                <td class="text-capitalize">
                                    <span v-if="viewLocation.location_schedules === null">N/A</span>
                                    <table class="table table-bordered" v-else>
                                        <thead>
                                        <tr>
                                            <th scope="col">Expected Hour</th>
                                            <th scope="col">Preferred Time</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="schedule in viewLocation.location_schedules">
                                            <td style="width: 150px !important;">{{ schedule.expected_hour }}</td>
                                            <td style="width: 150px !important;">{{ schedule.expected_time }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
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
                                            <tr v-for="log in viewLocation.location_log">
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

                <div class="modal-footer" >
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['view_url', 'view_location'],
        data() {
            return {
                viewLocation: { },
            }
        },
        methods: {
            getLocationInfo(id) {
                axios.get(this.view_url + '/' + id)
                    .then((response) => {
                        this.viewLocation = response.data;
                    })
                    .catch((error) => {
                        this.handleServerErrors(error);
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
            handleServerErrors(error) {
                let self = this;
                if(error.response.data.hasOwnProperty('error')) {
                    self.showToastMsg(error.response.data.error, 'error', 5000);
                }
                else if(error.response.data.hasOwnProperty('errors')) {
                    let serverErrors = error.response.data.errors;
                    for(let err in serverErrors) {
                        if(serverErrors.hasOwnProperty(err)) {
                            self.showToastMsg(serverErrors[err], 'error', 5000);
                        }
                    }
                }
                else if(error.response.hasOwnProperty('statusText')) {
                    self.showToastMsg(error.response.statusText, 'error', 5000);
                }
            }
        },
        watch: {
            view_location: function(id) {
                this.getLocationInfo(id);
            }
        }
    }
</script>