<template>
    <div class="franchise-wrapper account-view">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-xl-8">
                    <div class="card bsoft-card">
                        <div class="card-header text-center">
                            Register for Affiliate
                        </div>

                        <div class="card-body">
                            <form method="POST" @submit.prevent="updateProfile" v-if="!success">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="billing_first_name">First Name <span>*</span> </label>
                                        <input v-validate="'required|max:35|min:2'" data-vv-as="First Name" data-vv-validate-on="keyup" name="billing_first_name" :class="{'is-invalid' : errors.has('billing_first_name')}"
                                               type="text" v-model="first_name" class="form-control" id="billing_first_name" placeholder="First Name">
                                        <div class="invalid-feedback" v-if="errors.has('billing_first_name')">
                                            {{ errors.first('billing_first_name') }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="billing_last_name">Last Name <span>*</span> </label>
                                        <input v-validate="'required|max:35|min:2'" data-vv-as="Last Name" data-vv-validate-on="keyup" name="billing_last_name" :class="{'is-invalid': errors.has('billing_last_name')}"
                                               type="text" v-model="last_name" class="form-control" id="billing_last_name" placeholder="Last Name">
                                        <div class="invalid-feedback" v-if="errors.has('billing_last_name')">
                                            {{ errors.first('billing_last_name') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="billing_address">Address <span>*</span> </label>
                                    <textarea v-validate="'required|max:180|min:15'" data-vv-as="Address" data-vv-validate-on="keyup" name="billing_address" :class="{'is-invalid': errors.has('billing_address')}"
                                              v-model="address" id="billing_address" class="form-control" rows="3" style="resize: none;"></textarea>
                                    <div class="invalid-feedback" v-if="errors.has('billing_address')">
                                        {{ errors.first('billing_address') }}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="billing_city">City/District <span>*</span> </label>
                                        <input v-validate="'required|max:55|min:4'" data-vv-as="City or District" data-vv-validate-on="keyup" name="billing_city" :class="{'is-invalid': errors.has('billing_city')}"
                                               type="text" v-model="city" class="form-control" id="billing_city" placeholder="City">
                                        <div class="invalid-feedback" v-if="errors.has('billing_city')">
                                            {{ errors.first('billing_city') }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="billing_postcode">Postcode </label>
                                            <input v-validate="'max:5|min:4'" data-vv-as="Postcode" data-vv-validate-on="keyup" name="billing_postcode" :class="{'is-invalid': errors.has('billing_postcode')}"
                                                   type="text" v-model="postcode" class="form-control" id="billing_postcode" placeholder="Postcode">
                                            <div class="invalid-feedback" v-if="errors.has('billing_postcode')">
                                                {{ errors.first('billing_postcode') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="billing_email">Email <span>*</span> </label>
                                    <input v-validate="'required|email'" data-vv-as="Email" data-vv-validate-on="keyup" name="billing_email" :class="{'is-invalid': errors.has('billing_email')}"
                                           type="email" v-model="email" class="form-control" id="billing_email" placeholder="Enter Your email">
                                    <div class="invalid-feedback" v-if="errors.has('billing_email')">
                                        {{ errors.first('billing_email') }}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-6">
                                        <label for="billing_mobile">Mobile Primary <span>*</span> </label>
                                        <input v-validate="'required|mobile'" data-vv-as="Mobile Number Primary" data-vv-validate-on="keyup" name="billing_mobile" :class="{'is-invalid': errors.has('billing_mobile')}"
                                               type="tel" v-model="mobile" class="form-control" id="billing_mobile" placeholder="Mobile Number">
                                        <div class="invalid-feedback" v-if="errors.has('billing_mobile')">
                                            {{ errors.first('billing_mobile') }}
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="billing_mobile_secondary">Secondary Mobile</label>
                                        <input v-validate="'mobile'" data-vv-as="Secondary Mobile Number" data-vv-validate-on="keyup" name="billing_mobile_secondary" :class="{'is-invalid': errors.has('billing_mobile_secondary')}"
                                               type="tel" v-model="mobile_secondary" class="form-control" id="billing_mobile_secondary" placeholder="Secondary Mobile Number">
                                        <div class="invalid-feedback" v-if="errors.has('billing_mobile_secondary')">
                                            {{ errors.first('billing_mobile_secondary') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-6">
                                        <label for="password">Password <span>*</span> </label>
                                        <input v-validate="'required|min:8'" data-vv-as="Password" data-vv-validate-on="keyup" name="password" :class="{'is-invalid': errors.has('password')}"
                                               type="password" v-model="password" class="form-control" id="password" placeholder="Password" ref="password">
                                        <div class="invalid-feedback" v-if="errors.has('password')">
                                            {{ errors.first('password') }}
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="password_confirmation">Confirm Password <span>*</span> </label>
                                        <input v-validate="'required|min:8|confirmed:password'" data-vv-as="Password Confirmation" data-vv-validate-on="keyup" name="password_confirmation" :class="{'is-invalid': errors.has('password_confirmation')}"
                                               type="password" v-model="password_confirmation" class="form-control" id="password_confirmation" placeholder="Secondary Mobile Number">
                                        <div class="invalid-feedback" v-if="errors.has('password_confirmation')">
                                            {{ errors.first('password_confirmation') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group text-center" style="margin-top: 45px;">
                                    <button type="submit" class="btn btn-success">Register</button>
                                </div>
                            </form>

                            <div v-else>
                                <transition name="fade">
                                    <div class="registered text-center">
                                        <div class="happy">
                                            <i class="icon ion-md-happy"></i>
                                        </div>
                                        <h3>
                                            Your request for opening Franchise/Affiliate account has successfully taken!
                                        </h3>
                                        <br>
                                        <p>
                                            We'll contact with you immediately!
                                            <br>
                                            After confirming your request you'll also get your login details in your email.
                                            <br>
                                            <span>Thank You!</span>
                                        </p>
                                    </div>
                                </transition>
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
        data() {
            return {
                first_name: '',
                last_name: '',
                email: '',
                mobile: '',
                mobile_secondary: '',
                address: '',
                area: '',
                city: '',
                state: '',
                postcode: '',
                password: '',
                password_confirmation: '',

                success: false
            }
        },
        methods: {
            updateProfile() {
                this.$validator.validate().then(valid => {
                    if(!valid) {
                        this.$showErrorSwal({ title: 'Oops!', text: 'Please fill up fields correctly!' })
                    }
                    else {
                        axios.post('bs-client-api/franchise-register', {
                            first_name: this.first_name, last_name: this.last_name, email: this.email, mobile_primary: this.mobile,
                            mobile_secondary: this.mobile_secondary, address: this.address, city: this.city,
                            postcode: this.postcode, password: this.password,
                            password_confirmation: this.password_confirmation
                        }).then(response => {
                            this.$showSuccessSwal({ title: 'Success!', text: 'Franchise Account Request Successfully Placed!' });
                            this.success = true;
                        }).catch(error => {
                            //console.log(error.response);
                            if(error.response.data.errors && error.response.data.errors.email) {
                                this.$showErrorSwal({ title: 'Oops!', text: error.response.data.errors.email[0] });
                            }else if(error.response.data.errors && error.response.data.errors.mobile) {
                                this.$showErrorSwal({ title: 'Oops!', text: error.response.data.errors.mobile[0] });
                            } else if(typeof error.response.data.message !== 'undefined') {
                                this.$showErrorSwal({ title: 'Oops!', text: error.response.data.message });
                            } else if(typeof error.response.data.error !== 'undefined') {
                                this.$showErrorSwal({ title: 'Oops!', text: error.response.data.error });
                            }else {
                                this.$showErrorSwal({ title: 'Oops!', text: 'Something went wrong!' })
                            }
                        });
                    }
                });
            }
        },
        computed: {
            user() {
                return this.$store.state.user;
            },
        },
        created() {
            let self = this;
            let intVal = window.setInterval(function () {
                if(typeof self.user !== 'undefined' && self.user !== null) {
                    self.first_name = self.user.first_name;
                    self.last_name = self.user.last_name;
                    self.email = self.user.email;
                    self.mobile = '0' + self.user.mobile;
                    self.mobile_secondary = (self.user.mobile_secondary) ? '0' + self.user.mobile_secondary : '';
                    self.address = self.user.billing_address;
                    self.area = self.user.billing_area;
                    self.city = self.user.billing_city;
                    self.state = self.user.billing_state;
                    self.postcode = self.user.billing_postcode;
                    self.blood = self.user.blood_group;

                    //$('#billing_state ~ .nice-select .current').text(self.user.billing_state);
                    //$('#blood_group ~ .nice-select .current').val(self.user.blood_group);

                    clearInterval(intVal);
                }
            }, 500);
        },
        mounted() {
            let self = this;

            $(document).ready(function () {
                $('#billing_state').change(function() {
                    self.state = $(this).val();
                });

                $('#blood_group').change(function() {
                    self.blood = $(this).val();
                });
            });
        }
    }
</script>
