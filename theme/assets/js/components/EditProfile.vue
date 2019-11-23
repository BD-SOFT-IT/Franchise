<template>
    <div class="">
        <form enctype="multipart/form-data" method="POST" @submit.prevent="updateProfile">
            <div class="form-group text-center">
                <span class="text-center mx-auto position-relative">
                    <img :src="staticUrl + '/' + img_url" :alt="first_name" style="width: 200px; height: 200px; margin: 0 auto 25px;" v-if="!image.image_data && img_url && img_url.length > 7">
                    <img :src="image.image_data" :alt="first_name" style="width: 200px; height: 200px; margin: 0 auto 25px;" v-else-if="image.image_data">
                    <img :src="staticUrl + '/images/default_male.png'" :alt="first_name" style="width: 200px; height: 200px; margin: 0 auto 25px;" v-else>

                    <input type="file" v-validate="'mimes:image/jpeg,image/gif,image/png'" accept="image/*" @change="onFileChange"
                           :class="[(errors.has('image')) ? 'is-invalid' : '']" name="image" class="bsoft-file-input" id="uploadFile">

                    <span class="d-block invalid-feedback" style="margin-top: 10px;" v-if="errors.has('image')">
                        {{ errors.first('image') }}
                    </span>
                </span>
            </div>

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
                <label for="blood_group">Blood Group</label>
                <v-select placeholder="Select Blood Group" label="blood_group" id="blood_group"
                          :options="bloods"
                          v-model="blood">
                </v-select>
            </div>

            <div class="form-group">
                <label for="billing_address">Address <span>*</span> </label>
                <textarea v-validate="'required|max:180|min:15'" data-vv-as="Address" data-vv-validate-on="keyup" name="billing_address" :class="{'is-invalid': errors.has('billing_address')}"
                          v-model="address" id="billing_address" class="form-control" rows="3" style="resize: none;"></textarea>
                <div class="invalid-feedback" v-if="errors.has('billing_address')">
                    {{ errors.first('billing_address') }}
                </div>
            </div>

            <div class="form-group">
                <label for="billing_area">Area </label>
                <input type="text" v-model="area" class="form-control" id="billing_area" placeholder="Area">
            </div>

            <div class="form-group">
                <label for="billing_city">City/District <span>*</span> </label>
                <input v-validate="'required|max:55|min:4'" data-vv-as="City or District" data-vv-validate-on="keyup" name="billing_city" :class="{'is-invalid': errors.has('billing_city')}"
                       type="text" v-model="city" class="form-control" id="billing_city" placeholder="City">
                <div class="invalid-feedback" v-if="errors.has('billing_city')">
                    {{ errors.first('billing_city') }}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6">
                    <label for="billing_state">State/Division <span>*</span></label>
                    <v-select placeholder="Select State" label="billing_state" v-validate="'required'" data-vv-as="State or Division" data-vv-validate-on="change"
                              name="billing_state" :class="{'is-invalid': errors.has('billing_state')}"
                              id="billing_state"
                              :options="states"
                              v-model="state">
                    </v-select>

                    <div class="invalid-feedback" v-if="errors.has('billing_state')">
                        {{ errors.first('billing_state') }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="billing_postcode">Postcode </label>
                        <input v-validate="'required|max:5|min:4'" data-vv-as="Postcode" data-vv-validate-on="keyup" name="billing_postcode" :class="{'is-invalid': errors.has('billing_postcode')}"
                               type="text" v-model="postcode" class="form-control" id="billing_postcode" placeholder="Postcode">
                        <div class="invalid-feedback" v-if="errors.has('billing_postcode')">
                            {{ errors.first('billing_postcode') }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="billing_email">Email</label>
                <input v-validate="'email'" data-vv-as="Email" data-vv-validate-on="keyup" name="billing_email" :class="{'is-invalid': errors.has('billing_email')}"
                       type="email" v-model="email" class="form-control" id="billing_email" placeholder="Enter Your email">
                <div class="invalid-feedback" v-if="errors.has('billing_email')">
                    {{ errors.first('billing_email') }}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-6">
                    <label for="billing_mobile">Mobile <span>*</span> </label>
                    <input v-validate="'required|mobile'" data-vv-as="Mobile Number" data-vv-validate-on="keyup" name="billing_mobile" :class="{'is-invalid': errors.has('billing_mobile')}"
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

            <div class="form-group">
                <button type="submit" class="btn btn-success">Update Profile</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['staticUrl'],
        data() {
            return {
                states: ['Dhaka', 'Chittagong', 'Rajshahi', 'Mymensingh', 'Khulna', 'Barishal', 'Rangpur', 'Sylhet'],
                bloods: ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'],

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
                blood: '',
                img_url: '',

                image: {
                    image_data: null,
                    original_name: ''
                }
            }
        },
        methods: {
            updateProfile() {
                this.$validator.validate().then(valid => {
                    if(!valid) {
                        this.$showErrorSwal({ title: 'Oops!', text: 'Please fill up fields correctly!' })
                    }
                    else {
                        axios.patch('/bs-client-api/update-profile', {
                            first_name: this.first_name, last_name: this.last_name, email: this.email, mobile: this.mobile, mobile_secondary: this.mobile_secondary, address: this.address,
                            area: this.area, city: this.city, state: this.state, postcode: this.postcode, blood: this.blood, image: this.image.image_data, image_name: this.image.original_name
                        }).then(response => {
                            this.$showSuccessSwal({ title: 'Success!', text: 'Profile Successfully Updated!' });
                        }).catch(error => {
                            //console.log(error.response);
                            if(error.response.data.errors && error.response.data.errors.email) {
                                this.$showErrorSwal({ title: 'Oops!', text: error.response.data.errors.email[0] });
                            } else if(error.response.data.errors && error.response.data.errors.mobile) {
                                this.$showErrorSwal({ title: 'Oops!', text: error.response.data.errors.mobile[0] });
                            } else if(typeof error.response.data.error !== 'undefined') {
                                this.$showErrorSwal({ title: 'Oops!', text: error.response.data.error });
                            } else if(typeof error.response.data.message !== 'undefined') {
                                this.$showErrorSwal({ title: 'Oops!', text: error.response.data.message });
                            } else {
                                this.$showErrorSwal({ title: 'Oops!', text: 'Something went wrong!' })
                            }
                        });
                    }
                });
            },
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length) {
                    return;
                }
                this.createImage(files[0]);
                this.image.original_name = files[0].name;
            },
            createImage(file) {
                let reader = new FileReader();
                let self = this;
                reader.onload = (e) => {
                    self.image.image_data = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            setUser() {
                let self = this;
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
                self.img_url = self.user.img_url;
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
                    self.setUser();
                    clearInterval(intVal);
                }
            }, 500);
        },
        mounted() {

        }
    }
</script>

<style lang="css">
    .bsoft-file-input {
        width: 25px;
        height: 40px;
        position: absolute;
        bottom: -96px;
        right: -2px;
    }
    .bsoft-file-input::-webkit-file-upload-button {
        visibility: hidden;
    }
    .bsoft-file-input::before {
        content: "\F3F6";
        font-family: "Ionicons";
        display: inline-block;
        background: transparent;
        border: 0;
        border-radius: 3px;
        padding: 0;
        outline: none;
        white-space: nowrap;
        -webkit-user-select: none;
        cursor: pointer;
        text-shadow: 1px 1px #fff;
        font-weight: 600;
        font-size: 30px;
        color: var(--accent-color);
    }
    .bsoft-file-input:hover::before {
        border-color: black;
    }
    .bsoft-file-input:active::before {
        background: -webkit-linear-gradient(to bottom, #e3e3e3, #f9f9f9);
    }
    .v-select .vs__dropdown-toggle {
        border-color: #e5e5e5;
        border-radius: 2px;
        font-size: 13px;
        height: 40px;
    }
</style>
