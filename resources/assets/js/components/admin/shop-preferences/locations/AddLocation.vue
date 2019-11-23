<template>
    <form method="post" @submit.prevent="addLocation">

        <div class="form-group row">
            <label for="locationType" class="col-md-3 col-form-label">Type</label>
            <div class="col-md-9">
                <select class="custom-select" :class="{'is-invalid' : errors.has('location_type')}" v-validate="'required'"
                        name="location_type" id="locationType" v-model="locationType" data-vv-as="Location Type">
                    <option :value="null">--- Select Location Type ---</option>
                    <option value="country">Country</option>
                    <option value="state">State (Division)</option>
                    <option value="city">City (District)</option>
                    <option value="area">Local Area</option>
                </select>

                <div class="invalid-feedback" v-if="errors.has('location_type')">
                    {{ errors.first('location_type') }}
                </div>
            </div>
        </div>
        <!-- Countries -->
        <div class="form-group row" v-if="locationType !== null && locationType !== 'country'">
            <label for="locationParentCountry" class="col-md-3 col-form-label">Country</label>
            <div class="col-md-9">
                <select class="custom-select" :class="{'is-invalid' : errors.has('location_country')}" v-validate="'required'"
                        name="location_country" id="locationParentCountry" v-model="locationCountry" data-vv-as="Location Country">
                    <option :value="null" selected>--- Select Country ---</option>
                    <option v-for="country in $parent.countries" :value="country.location_id">{{ country.location_name }}</option>
                </select>

                <div class="invalid-feedback" v-if="errors.has('location_country')">
                    {{ errors.first('location_country') }}
                </div>
            </div>
        </div>
        <!-- States -->
        <div class="form-group row" v-if="locationCountry !== null && locationType !== 'state'">
            <label for="locationParentState" class="col-md-3 col-form-label">State</label>
            <div class="col-md-9">
                <select class="custom-select" :class="{'is-invalid' : errors.has('location_state')}" v-validate="'required'"
                        name="location_state" id="locationParentState" v-model="locationState" data-vv-as="Location State">
                    <option :value="null" selected>--- Select State ---</option>
                    <option v-for="state in locationParentStates" :value="state.location_id">{{ state.location_name }}</option>
                </select>

                <div class="invalid-feedback" v-if="errors.has('location_state')">
                    {{ errors.first('location_state') }}
                </div>
            </div>
        </div>
        <!-- Cities -->
        <div class="form-group row" v-if="locationState !== null && locationType !== 'city'">
            <label for="locationParentCity" class="col-md-3 col-form-label">City</label>
            <div class="col-md-9">
                <select class="custom-select" :class="{'is-invalid' : errors.has('location_city')}" v-validate="'required'"
                        name="location_city" id="locationParentCity" v-model="locationCity" data-vv-as="Location City">
                    <option :value="null" selected>--- Select City ---</option>
                    <option v-for="city in locationParentCities" :value="city.location_id">{{ city.location_name }}</option>
                </select>

                <div class="invalid-feedback" v-if="errors.has('location_city')">
                    {{ errors.first('location_city') }}
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="locationName" class="col-md-3 col-form-label">Name</label>
            <div class="col-md-9">
                <input type="text" class="form-control" :class="{'is-invalid' : errors.has('location_name')}" v-validate="'required|min:3|max:150'"
                       data-vv-as="Location Name" name="location_name" id="locationName" v-model="locationName" placeholder="Location Name">

                <div class="invalid-feedback" v-if="errors.has('location_name')">
                    {{ errors.first('location_name') }}
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="locationNameBengali" class="col-md-3 col-form-label">Name <span class="adorsho-lipi-12">(বাংলা)</span></label>
            <div class="col-md-9">
                <input type="text" class="form-control" :class="{'is-invalid' : errors.has('location_name')}" v-validate="'required|min:3|max:150'"
                       data-vv-as="Location Name Bengali" name="location_name_bengali" id="locationNameBengali" v-model="locationNameBengali" placeholder="জায়গার নাম">

                <div class="invalid-feedback" v-if="errors.has('location_name')">
                    {{ errors.first('location_name') }}
                </div>
            </div>
        </div>

        <div class="form-group row" v-if="locationType === 'area'">
            <label for="locationSelected" class="col-md-3 col-form-label">Selected for Grocery</label>
            <div class="col-md-9">
                <toggle-button v-model="locationSelected" :width="100" id="locationSelected" color="#00a65a" class="rbt-toggle-btn mt-2"
                               :sync="true" :labels="{checked: 'Selected', unchecked: 'Not Selected'}"/>
            </div>
        </div>

        <!-- Delivery Schedules -->
        <div class="form-group row">
            <label title="Location Schedules" class="col-md-3 col-form-label">Delivery Schedules</label>
            <div class="col-md-9">
                <ul class="list-group pull-right mt-2 w-100" v-if="selectedDeliveryScheduleObjects.length > 0">
                    <li class="list-group-item" v-for="(schedule, index) in selectedDeliveryScheduleObjects" style="padding: 7px 15px;">
                        <strong>Expected Hour: </strong>{{ schedule.expected_hour }}, <strong>Preferred Time: </strong> {{ schedule.expected_time }}
                        <span class="pull-right text-danger" @click.prevent="removeSchedule(index)" style="margin-left: 15px; cursor: pointer;" title="Remove">
                            <i class="fa fa-times"></i>
                        </span>
                    </li>
                </ul>
                <schedule-auto-suggest-input :options_data="schedules" @selected="addSchedule"></schedule-auto-suggest-input>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-9 offset-md-3">
                <button type="submit" :disabled="!showAddButton" class="btn btn-success">Add Location</button>
            </div>
        </div>

    </form>
</template>

<script>
    import ScheduleAutoSuggestInput from '../../auto-suggest-inputs/ScheduleAutoSuggestInput';
    export default {
        props: ['add_url'],
        components: { ScheduleAutoSuggestInput },
        data() {
            return {
                locationType: null,
                locationName: '',
                locationNameBengali: '',
                locationSelected: false,

                locationCountry: null,
                locationState: null,
                locationCity: null,

                locationParentStates: [],
                locationParentCities: [],

                schedules: [],
                selectedDeliveryScheduleObjects: [],
            }
        },
        methods: {
            addLocation() {
                let location = {
                    location_type: this.locationType,
                    location_parent: this.locationParent,
                    location_name: this.locationName,
                    location_name_bengali: this.locationNameBengali,
                    location_delivery_schedules: this.locationSchedulesID,
                    location_selected: this.locationSelected
                };
                axios.post(this.add_url, location)
                    .then((response) => {
                        this.showToastMsg('Location successfully added!', 'success', 3000);
                        this.locationType = this.locationCity = this.locationState = this.locationCountry = null;
                        this.locationParentStates = this.locationParentCities = this.selectedDeliveryScheduleObjects = [];
                        this.locationName = this.locationNameBengali = '';
                        this.$emit('location-added');
                    })
                    .catch((error) => {
                        this.handleServerErrors(error);
                    });
            },
            fetchSchedules() {
                axios.get('/bs-admin-api/shop-preferences/locations/schedules-for-location')
                    .then((response) => {
                        this.schedules = response.data;
                    })
                    .catch((error) => {
                        this.handleServerErrors(error);
                    });
            },
            addSchedule(schedule) {
                if(this.selectedDeliveryScheduleObjects.includes(schedule)) {
                    this.showToastMsg('Schedule Already Exists..!', 'error', 5000);
                }
                else {
                    this.selectedDeliveryScheduleObjects.push(schedule);
                    this.showToastMsg('Schedule added!!', 'success', 3000);
                }
            },
            removeSchedule(index) {
                if(index > -1) {
                    this.selectedDeliveryScheduleObjects.splice(index, 1);
                    this.showToastMsg('Schedule Removed..!', 'success', 2000);
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
            },
            /*getLocationDetails(id) {
                axios.get(this.edit_url + '/' + id)
                    .then((response) => {
                        this.locationType = response.data.type;
                        this.locationName = response.data.name;
                        this.locationCountry = response.data.country;
                        this.locationState = response.data.state;
                        this.locationId = id;
                    })
                    .catch((error) => {
                        if(error.response.status === 404) {
                            this.showToast('Location not found!', 'error', 5000);
                        }
                        else {
                            this.showToast('Something went wrong!', 'error', 5000);
                        }
                    });
            },
            updateLocation() {
                this.serverErrors = { };
                let location = {
                    type: this.locationType,
                    parent: this.locationParent,
                    name: this.locationName
                };
                axios.patch(this.edit_url + '/' + this.locationId, location)
                    .then((response) => {
                        this.showToast('Location successfully updated!', 'success', 3000);
                        this.locationId = this.locationName = this.locationType = this.locationState = this.locationCountry = '';
                        this.locationParentStates = [];
                        this.serverErrors = {};
                        this.$emit('at-success');
                        $('#editLocationModal').modal('hide');
                    })
                    .catch((error) => {
                        if(error.response.status === 500) {
                            this.showToast('Something went wrong!', 'error', 5000);
                        }
                        else if(error.response.status === 404) {
                            this.showToast('Location not found!', 'error', 5000);
                        }
                        else {
                            this.serverErrors = error.response.data.errors;
                        }
                    });
            },
            mounted() {
                if(this.edit_location !== null || this.edit_location !== undefined) {
                    this.getLocationDetails(this.edit_location);
                }
                else {
                    this.locationId = this.locationName = this.locationType = this.locationState = this.locationCountry = '';
                    this.locationParentStates = [];
                    this.serverErrors = {};
                }
            }*/
        },
        watch: {
            locationType: function(type) {
                switch(type) {
                    case 'country':
                        this.locationCountry = this.locationState = this.locationCity = null;
                        break;
                    case 'state':
                        this.locationState = this.locationCity = null;
                        break;
                    case 'city':
                        this.locationCity = null;
                        break;
                    default:
                        break;
                }
            },
            locationCountry: function(country) {
                let self = this;
                let states = self.$parent.states;
                self.locationParentStates = [];
                if(country === null) {
                    self.locationParentStates = [];
                    return;
                }
                states.forEach(function(state) {
                    if(state.location_parent == country) {
                        self.locationParentStates.push(state);
                    }
                });
            },
            locationState: function(state) {
                let self = this;
                let cities = self.$parent.cities;
                self.locationParentCities = [];
                if(state === null) {
                    self.locationParentCities = [];
                    return;
                }
                cities.forEach(function(city) {
                    if(city.location_parent == state) {
                        self.locationParentCities.push(city);
                    }
                });
            }
        },
        computed: {
            showAddButton() {
                if(Object.keys(this.fields).some(key => this.fields[key].invalid)) {
                    return false;
                }
                return !(this.locationSelected && this.selectedDeliveryScheduleObjects.length <= 0);
            },
            locationParent() {
                let self = this;
                let parent = null;
                switch(self.locationType) {
                    case 'state':
                        parent = self.locationCountry;
                        break;
                    case 'city':
                        parent = self.locationState;
                        break;
                    case 'area':
                        parent = self.locationCity;
                        break;
                    default:
                        parent = null;
                        break;
                }
                return parent;
            },
            locationSchedulesID() {
                let self = this;
                let schedules = [];
                self.selectedDeliveryScheduleObjects.forEach((schedule) => {
                    schedules.push(schedule.id);
                });
                if(schedules.length <= 0) {
                    return null;
                }
                return schedules;
            }
        },
        created() {
            this.fetchSchedules();
        }
    }
</script>
