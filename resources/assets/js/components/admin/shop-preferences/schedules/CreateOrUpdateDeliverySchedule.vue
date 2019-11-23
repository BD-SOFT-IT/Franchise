<template>
    <form @submit.prevent="updateSchedule">
        <div class="form-group row">
            <label for="hourFrom" class="col-sm-2 col-form-label">Expected Hour Range</label>
            <label for="hourTo" class="sr-only">Expected Hour To</label>
            <div class="col-sm-5">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="hourFrom" v-validate="'decimal:2'" data-vv-as="Expected Delivery Hour From" name="hour_from"
                           v-model="schedule.schedule_expected_hour_from" :class="{'is-invalid' : errors.has('hour_from')}" placeholder="From">
                    <div class="input-group-append">
                        <span class="input-group-text">Hours</span>
                    </div>

                    <div class="invalid-feedback" v-if="errors.has('hour_from')">
                        {{ errors.first('hour_from') }}
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="hourTo" v-validate="'decimal:2'" data-vv-as="Expected Delivery Hour To" name="hour_to"
                           v-model="schedule.schedule_expected_hour_to" :class="{'is-invalid' : errors.has('hour_to')}" placeholder="To">
                    <div class="input-group-append">
                        <span class="input-group-text">Hours</span>
                    </div>

                    <div class="invalid-feedback" v-if="errors.has('hour_to')">
                        {{ errors.first('hour_to') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="timeFrom" class="col-sm-2 col-form-label">Expected Time Range</label>
            <label for="timeTo" class="sr-only">Expected Time To</label>
            <div class="col-sm-5">
                <div class="input-group">
                    <div class="input-group-append">
                        <span class="input-group-text">From</span>
                    </div>
                    <select class="custom-select" id="timeFrom" v-model="schedule.schedule_expected_time_from">
                        <option :value="null" >--- Select Time ---</option>
                        <option v-for="time in times" :value="time.value">
                            {{ time.text }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="input-group">
                    <div class="input-group-append">
                        <span class="input-group-text">To</span>
                    </div>
                    <select class="custom-select" id="timeTo"  v-model="schedule.schedule_expected_time_to">
                        <option :value="null">--- Select Time ---</option>
                        <option v-for="time in times" :value="time.value">
                            {{ time.text }}
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-success">{{ actionBtn }}</button>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        props: ['schedule_data'],
        data() {
            return {
                schedule: {
                    schedule_id: null,
                    schedule_expected_time_from: null,
                    schedule_expected_time_to: null,
                    schedule_expected_hour_from: '',
                    schedule_expected_hour_to: ''
                },
                actionBtn: 'Add Schedule',
                times: [
                    { value: '06:00:00', text: '06:00 AM' },
                    { value: '07:00:00', text: '07:00 AM' },
                    { value: '08:00:00', text: '08:00 AM' },
                    { value: '09:00:00', text: '09:00 AM' },
                    { value: '10:00:00', text: '10:00 AM' },
                    { value: '11:00:00', text: '11:00 AM' },
                    { value: '12:00:00', text: '12:00 PM' },
                    { value: '13:00:00', text: '01:00 PM' },
                    { value: '14:00:00', text: '02:00 PM' },
                    { value: '15:00:00', text: '03:00 PM' },
                    { value: '16:00:00', text: '04:00 PM' },
                    { value: '17:00:00', text: '05:00 PM' },
                    { value: '18:00:00', text: '06:00 PM' },
                    { value: '19:00:00', text: '07:00 PM' },
                    { value: '20:00:00', text: '08:00 PM' },
                    { value: '21:00:00', text: '09:00 PM' },
                    { value: '22:00:00', text: '10:00 PM' }
                ]
            }
        },
        methods: {
            updateSchedule() {
                if(typeof this.schedule_data === 'object') {
                    axios.patch(this.$parent.apiUrl + '/edit/' + this.schedule.schedule_id, this.schedule)
                        .then((response) => {
                            this.$emit('schedule-updated');
                        })
                        .catch((error) => {
                            this.handleServerErrors(error);
                        });
                }
                else {
                    axios.post(this.$parent.apiUrl + '/add', this.schedule)
                        .then((response) => {
                            this.$emit('schedule-created');
                        })
                        .catch((error) => {
                            this.handleServerErrors(error);
                        });
                }
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
        mounted() {
            if(typeof this.schedule_data === 'object') {
                this.schedule = this.schedule_data;
                this.actionBtn = 'Update Schedule'
            }
        }
    }
</script>