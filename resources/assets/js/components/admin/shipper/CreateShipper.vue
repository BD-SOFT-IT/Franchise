<template>
    <div class="card new-admin">
        <div class="card-header">
            <span v-if="shipper_data === undefined">
                <strong><i class="fa fa-plus"></i> Add</strong> Shipper
            </span>
            <span v-else>
                <strong><i class="fa fa-pencil"></i> Edit</strong> Shipper
            </span>
        </div>
        <div class="card-body">
            <form method="POST" @submit.prevent="addOrUpdateShipper">

                <div class="form-group row">
                    <label for="shipperOwner" class="col-sm-2 col-form-label">Shipper Provider: </label>

                    <div class="custom-control custom-radio custom-control-inline" style="margin-top: 7px;">
                        <input type="radio" id="shipperOwner" name="shipper_own" :value="true" v-model="shipper.shipper_own" class="custom-control-input" required>
                        <label class="custom-control-label" for="shipperOwner">Own Company</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline" style="margin-top: 7px;">
                        <input type="radio" id="customRadio2" name="shipper_own" :value="false" v-model="shipper.shipper_own" class="custom-control-input" required>
                        <label class="custom-control-label" for="customRadio2">Third-Party Shipping Company</label>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="first_name" class="col-sm-2 col-form-label">Name</label>
                    <label for="last_name" class="sr-only">Last Name</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="first_name" name="first_name" v-model="shipper.shipper_first_name" v-validate="'required|max:55'"
                               data-vv-validate-on="keyup" data-vv-as="First Name" placeholder="First Name">

                        <span class="invalid-feedback" v-if="errors.has('first_name')">
                            <strong>{{ errors.first('first_name') }}</strong>
                        </span>
                    </div>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="last_name" name="last_name" v-model="shipper.shipper_last_name" v-validate="'required|max:55'"
                               data-vv-validate-on="keyup" data-vv-as="Last Name" placeholder="Last Name">

                        <span class="invalid-feedback" v-if="errors.has('last_name')">
                            <strong>{{ errors.first('last_name') }}</strong>
                        </span>
                    </div>
                </div>

                <div class="form-group row" v-if="!shipper.shipper_own">
                    <label for="shipper_company" class="col-sm-2 col-form-label">Company Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="shipper_company" name="shipper_company" v-model="shipper.shipper_company" v-validate="'required|min:3'" data-vv-validate-on="keyup"
                               data-vv-as="Company Name" placeholder="Company Name">

                        <span class="invalid-feedback" v-if="errors.has('shipper_company')">
                            <strong>{{ errors.first('shipper_company') }}</strong>
                        </span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" v-model="shipper.email" v-validate="'email'" data-vv-validate-on="keyup"
                               data-vv-as="Email Address" placeholder="Email Address">

                        <span class="invalid-feedback" v-if="errors.has('email')">
                            <strong>{{ errors.first('email') }}</strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row" v-if="shipper.shipper_own">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" v-model="shipper.shipper_password"
                               v-validate="'required|min:8'" data-vv-validate-on="keyup" placeholder="Password" aria-describedby="passwordHelp" ref="password">

                        <small id="passwordHelp" class="form-text text-muted">
                            Password must be at least 8 characters.
                        </small>
                        <span v-show="errors.has('password')" class="invalid-feedback">{{ errors.first('password') }}</span>

                    </div>
                </div>
                <div class="form-group row" v-if="shipper.shipper_own">
                    <label for="confPassword" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="confPassword" name="password_confirmation" v-model="shipper.shipper_password_confirmation"
                               v-validate="'required|min:8|confirmed:password'" data-vv-validate-on="keyup" placeholder="Confirm Password">
                        <span v-show="errors.has('password_confirmation')" class="invalid-feedback">{{ errors.first('password_confirmation') }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mobile" class="col-sm-2 col-form-label">Mobile No</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="mobile" name="mobile_primary" v-model="shipper.mobile_primary" placeholder="Primary Mobile Number"
                               v-validate="'required|mobile'" data-vv-validate-on="keyup" data-vv-as="Mobile Number">
                        <span v-show="errors.has('mobile_primary')" class="invalid-feedback">{{ errors.first('mobile_primary') }}</span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="shipper_address" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <textarea name="shipper_address" class="form-control" id="shipper_address" rows="3" v-model="shipper.shipper_address" v-validate="'required|min:15|max:180'" data-vv-validate-on="keyup" data-vv-as="Address"></textarea>
                        <span v-show="errors.has('shipper_address')" class="invalid-feedback">{{ errors.first('shipper_address') }}</span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-success">
                            {{ btnText }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['api', 'shipper_data'],
        data() {
            return {
                shipper: {
                    shipper_user_id: null,
                    shipper_first_name: '',
                    shipper_last_name: '',
                    shipper_name: '',
                    shipper_password: null,
                    shipper_password_confirmation: null,
                    shipper_company: null,
                    shipper_website: null,
                    shipper_address: '',
                    mobile_primary: '',
                    email: null,
                    shipper_own: true
                },
                btnText: 'Add Shipper'
            }
        },
        // Component Methods
        methods: {
            selectShipperOwner() {

            },
            addOrUpdateShipper() {
                this.$validator.validate().then(valid => {
                    if (!valid) {
                        this.showToastMsg('Fill up required fields!', 'error', 4000);
                    }
                    else {
                        axios.post(this.api, this.shipper)
                            .then((response) => {
                                this.showToastMsg(response.data, 'success', 3500);
                            })
                            .catch((error) => {
                                console.log(error.response);
                            });
                    }
                });
            },
            initShipper() {
                if(typeof this.shipper_data === 'object' && this.shipper_data.hasOwnProperty('shipper_id')) {
                    this.shipper = this.shipper_data;
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
            }
        },
        watch: {
            'shipper.shipper_first_name': function (val) {
                this.shipper.shipper_name = val + ' ' + this.shipper.shipper_last_name;
            },
            'shipper.shipper_last_name': function (val) {
                this.shipper.shipper_name = this.shipper.shipper_first_name + ' ' + val;
            }
        },
        // Functions to do on time of creation
        created() {
            this.initShipper();
        }
    }
</script>
