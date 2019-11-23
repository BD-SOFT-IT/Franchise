<template>
    <div class="admin-sp-locations">
        <div class="card">
            <div class="card-header">
                <span v-html="topNav.header"></span>
                <a href="" class="pull-right" :title="topNav.title" v-html="topNav.text" @click.prevent="toggleViewByTopBtn"></a>
            </div>
            <div class="card-body">
                <transition name="fade">
                    <div class="accordion" id="countryAccordions" v-if="activeView === 'index'">
                    <div class="card" style="border-bottom: 1px solid #dbe1e8;" v-for="country in countries">
                        <div class="card-header" :id="'heading' + country.location_id">
                            <div class="h5 mb-0">
                                <button class="btn btn-link" type="button" @click="selectLocation(country.location_id, country.location_type)">
                                    <strong>{{ country.location_name }}</strong>
                                    <span class="text-muted text-capitalize font-weight-light">({{ country.location_type }})</span>
                                </button>
                                <div class="btn-group pull-right" role="group">
                                    <button type="button" @click.prevent="viewLocation(country.location_id)" class="btn btn-light text-info" title="View This Location"><i class="fa fa-eye"></i></button>
                                    <button type="button" @click.prevent="editLocation(country.location_id)" class="btn btn-light text-warning" title="Edit This Location"><i class="fa fa-pencil"></i></button>
                                    <button type="button" @click.prevent="showDeleteLocationModal(country)" class="btn btn-light text-danger" title="Delete This Location"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>

                        <div :id="'collapse' + country.location_id" class="collapse" :class="{'show' : country.location_id == selectedCountryId}" :aria-labelledby="'heading' + country.location_id" data-parent="#countryAccordions">
                            <div class="card-body" v-if="country.location_id == selectedCountryId">

                                <!-- States -->
                                <div class="accordion" id="stateAccordions">
                                    <div class="card" v-for="state in selectedStates">
                                        <div class="card-header" :id="'heading' + state.location_id">
                                            <div class="mb-0">
                                                <button class="btn btn-link" type="button" @click="selectLocation(state.location_id, state.location_type)">
                                                    <strong>{{ state.location_name }}</strong>
                                                    <span class="text-muted text-capitalize font-weight-light">({{ state.location_type }})</span>
                                                </button>
                                                <div class="btn-group pull-right" role="group">
                                                    <button type="button" @click.prevent="viewLocation(state.location_id)" class="btn btn-light text-info" title="View This Location"><i class="fa fa-eye"></i></button>
                                                    <button type="button" @click.prevent="editLocation(state.location_id)" class="btn btn-light text-warning" title="Edit This Location"><i class="fa fa-pencil"></i></button>
                                                    <button type="button" @click.prevent="showDeleteLocationModal(state)" class="btn btn-light text-danger" title="Delete This Location"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                        <div :id="'collapse' + state.location_id" class="collapse" :class="{'show' : state.location_id == selectedStateId}" :aria-labelledby="'heading' + state.location_id" data-parent="#stateAccordions">
                                            <div class="card-body" v-if="state.location_id == selectedStateId">

                                                <!-- Cities -->
                                                <div class="accordion" id="cityAccordions">
                                                    <div class="card" v-for="city in selectedCities">
                                                        <div class="card-header" :id="'heading' + city.location_id">
                                                            <div class="mb-0">
                                                                <button class="btn btn-link" type="button" @click="selectLocation(city.location_id, city.location_type)">
                                                                    <strong>{{ city.location_name }}</strong>
                                                                    <span class="text-muted text-capitalize font-weight-light">({{ city.location_type }})</span>
                                                                </button>
                                                                <div class="btn-group pull-right" role="group">
                                                                    <button type="button" @click.prevent="viewLocation(city.location_id)" class="btn btn-light text-info" title="View This Location"><i class="fa fa-eye"></i></button>
                                                                    <button type="button" @click.prevent="editLocation(city.location_id)" class="btn btn-light text-warning" title="Edit This Location"><i class="fa fa-pencil"></i></button>
                                                                    <button type="button" @click.prevent="showDeleteLocationModal(city)" class="btn btn-light text-danger" title="Delete This Location"><i class="fa fa-trash"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div :id="'collapse' + city.location_id" class="collapse" :class="{'show' : city.location_id === selectedCityId}" :aria-labelledby="'heading' + city.location_id" data-parent="#cityAccordions">
                                                            <div class="card-body" v-if="city.location_id === selectedCityId">
                                                                <!-- Area -->
                                                                <div class="accordion" id="areaAccordions">
                                                                    <div class="card" v-for="area in selectedAreas">
                                                                        <div class="card-header" :id="'heading' + area.location_id">
                                                                            <div class="mb-0">
                                                                                <button class="btn btn-link" type="button">
                                                                                    <strong>{{ area.location_name }}</strong>
                                                                                    <span class="text-muted text-capitalize font-weight-light">({{ area.location_type }})</span>
                                                                                    <small v-if="area.location_selected">Selected for Express Delivery</small>
                                                                                </button>
                                                                                <div class="btn-group pull-right" role="group">
                                                                                    <button type="button" @click.prevent="viewLocation(area.location_id)" class="btn btn-light text-info" title="View This Location"><i class="fa fa-eye"></i></button>
                                                                                    <button type="button" @click.prevent="editLocation(area.location_id)" class="btn btn-light text-warning" title="Edit This Location"><i class="fa fa-pencil"></i></button>
                                                                                    <button type="button" @click.prevent="showDeleteLocationModal(area)" class="btn btn-light text-danger" title="Delete This Location"><i class="fa fa-trash"></i></button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> <!-- #areaAccordions -->

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <!-- #cityAccordions -->

                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- #stateAccordions -->

                            </div>
                        </div>
                    </div>
                </div> <!-- #countryAccordions -->
                </transition>

                <!-- Add Location -->
                <transition name="fade">
                    <add-location :add_url="api_url + '/add'" @location-added="refreshLocations" v-if="activeView === 'create'"></add-location>
                </transition>

                <!-- Edit Location -->
                <transition name="fade">
                    <edit-location :edit_url="api_url + '/edit'" :edit_location_id="locationForEdit" @location-updated="refreshLocations" v-if="activeView === 'edit'"></edit-location>
                </transition>
            </div>
        </div>

        <!-- Edit Location Modal -->


        <!-- View Location Modal -->
        <view-location :view_url="api_url + '/view'" :view_location="locationForView" @show-toast="makeToast"></view-location>

        <!-- Delete Location Modal -->
        <div class="modal fade wow animated bounceInUp" id="deleteLocationModal" tabindex="-1" role="dialog"
             aria-labelledby="deleteLocationModalLabel" aria-hidden="true" data-wow-duration="1s">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title w-100" id="deleteLocationModalLabel">Delete Location</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body text-center" style="font-size: 14px; letter-spacing: 0.03em;">
                        Are you sure want to delete this location?
                        <br>
                        <span v-html="deleteText"></span>
                    </div>

                    <div class="modal-footer" >
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" @click.prevent="deleteLocation">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import AddLocation from './AddLocation';
    import EditLocation from './EditLocation';
    import ViewLocation from './ViewLocation';

    export default {
        props: ['api_url'],
        components: {
            'add-location': AddLocation,
            'edit-location': EditLocation,
            'view-location': ViewLocation
        },
        data() {
            return {
                topNav: {
                    header: '<strong><i class="fa fa-globe"></i> Delivery</strong> Locations',
                    title: 'Add New Delivery Location',
                    text: '<i class="fa fa-plus"></i> Add'
                },
                activeView: 'index', // index or create or edit

                countries: [],
                states: [],
                cities: [],
                areas: [],
                selectedLocations: [], // grocery delivery locations

                selectedCountryId: null,
                selectedStateId: null,
                selectedCityId: null,

                selectedStates: [],
                selectedCities: [],
                selectedAreas: [],

                locationForView: null,
                locationForEdit: null,
                locationForDelete: null,
                deleteText: ''
            }
        },
        methods: {
            getLocations() {
                axios.get(this.api_url)
                    .then((response) => {
                        this.countries = response.data.countries;
                        this.selectedCountryId = response.data.countries[0].location_id;
                        this.states = response.data.states;
                        this.cities = response.data.cities;
                        this.areas = response.data.areas;
                        this.selectedLocations = response.data.selected;
                        this.selectStates(this.selectedCountryId);
                    })
                    .catch((error) => {
                        this.handleServerErrors(error);
                    });
            },
            selectLocation(id, type) {
                let self = this;
                switch(type) {
                    case 'country':
                        self.selectStates(id);
                        break;
                    case 'state':
                        self.selectCities(id);
                        break;
                    case 'city':
                        self.selectAreas(id);
                        break;
                }
                $('#collapse' + id).collapse('toggle');
            },
            selectStates(id) { // country id
                let self = this;
                self.selectedCountryId = id;
                self.selectedStates = [];
                let states = self.states.filter(function(state) {
                    return state.location_parent == id;
                });
                if(states.length === 0) {
                    self.selectedStateId = null;
                }
                else {
                    self.selectedStates = states;
                    self.selectedStateId = states[0].location_id;
                    self.selectCities(self.selectedStateId);
                }
            },
            selectCities(id) { // state id
                let self = this;
                self.selectedStateId = id;
                self.selectedCities = [];
                let cities = self.cities.filter(function(city) {
                    return city.location_parent == id;
                });
                if(cities.length === 0) {
                    self.selectedCityId = null;
                }
                else {
                    self.selectedCities = cities;
                    self.selectedCityId = cities[0].location_id;
                    self.selectAreas(self.selectedCityId);
                }
            },
            selectAreas(id) { // city id
                let self = this;
                self.selectedCityId = id;
                self.selectedAreas = [];
                let areas = self.areas.filter(function(area) {
                    return area.location_parent == id;
                });
                self.selectedAreas = areas;
            },
            editLocation(id) {
                this.locationForEdit = id;
                this.changeView('edit');
            },
            showDeleteLocationModal(location) {
                this.locationForDelete = location.location_id;
                if(location.location_type === 'country') {
                    this.deleteText = 'It will also delete all <strong>States</strong>, <strong>Cities</strong> and <strong>Areas</strong> ' +
                        'belongs to <strong class="text-uppercase">' + location.location_name + '</strong>';
                }
                else if(location.location_type === 'state') {
                    this.deleteText = 'It will also delete all <strong>Cities</strong> and <strong>Areas</strong> ' +
                        'belongs to <strong class="text-uppercase">' + location.location_name + '</strong>';
                }
                else if(location.location_type === 'city') {
                    this.deleteText = 'It will also delete all <strong>Areas</strong> ' + 'belongs to <strong class="text-uppercase">' + location.location_name + '</strong>';
                }
                else {
                    this.deleteText = '';
                }
                $('#deleteLocationModal').modal('show');
            },
            deleteLocation() {
                axios.delete(this.api_url + '/delete/' + this.locationForDelete)
                    .then((response) => {
                        this.showToastMsg('Location deleted successfully!', 'success', 3000);
                        this.refreshLocations();
                        $('#deleteLocationModal').modal('hide');
                    })
                    .catch((error) => {
                        this.handleServerErrors(error);
                    });
            },
            viewLocation(id) {
                this.locationForView = id;
                $('#viewLocationModal').modal('show');
            },
            refreshLocations() {
                this.getLocations();
                this.locationForEdit = null;
                this.locationForDelete = null;
                this.changeView('index');
            },
            changeView(view) {
                let self = this;
                switch(view) {
                    case 'create':
                        this.topNav = {
                            header: '<strong><i class="fa fa-plus"></i> New Delivery</strong> Location',
                            title: 'All Delivery Locations',
                            text: '<i class="fa fa-list"></i> All'
                        };
                        this.activeView = 'create';
                        break;
                    case 'edit':
                        this.topNav = {
                            header: '<strong><i class="fa fa-pencil"></i> Edit Delivery</strong> Location',
                            title: 'All Delivery Locations',
                            text: '<i class="fa fa-list"></i> All'
                        };
                        this.activeView = 'edit';
                        break;
                    default:
                        this.topNav = {
                            header: '<strong><i class="fa fa-globe"></i> Delivery</strong> Locations',
                            title: 'Add New Delivery Location',
                            text: '<i class="fa fa-plus"></i> Add'
                        };
                        self.activeView = 'index';
                        break;
                }
            },
            toggleViewByTopBtn() {
                if(this.activeView !== 'index') {
                    this.changeView('index');
                }
                else {
                    this.changeView('create');
                }
            },
            makeToast(toast) {
                this.showToastMsg(toast.msg, toast.method, toast.duration);
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
        created() {
            this.getLocations();
        }
    }
</script>
