<template>
    <div class="new-brand" :class="{'modal fade' : showAsModal}" id="createProductBrandModal"
         :role="showAsModal ? 'dialog' : ''" :tabindex="showAsModal ? '-1' : ''" :aria-labelledby="showAsModal ? 'createProductBrandModalLabel' : ''" :aria-hidden="showAsModal ? 'true' : 'false'">
        <div :class="{'modal-dialog modal-lg': showAsModal}">
            <div :class="{'modal-content' : showAsModal}">
                <div class="modal-header" v-if="showAsModal">
                    <h5 class="modal-title" id="createProductBrandModalLabel">
                        {{ brand_id === undefined ? 'Create New Brand' : 'Edit Brand' }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div :class="{'modal-body' : showAsModal}">
                    <form method="post" @submit.prevent="updateBrand">
                        <div class="form-group row">
                            <label for="brandName" class="col-sm-3 col-lg-2 col-form-label">Brand Name</label>
                            <div class="col-sm-9 col-lg-10">
                                <input type="text" class="form-control" id="brandName" name="pb_name" v-validate="'required|max:25|min:2'" data-vv-as="Brand Name" data-vv-validate-on="keyup"
                                       :class="{'is-invalid' : errors.has('pb_name')}" v-model="newBrand.pb_name" placeholder="Enter Brand Name">

                                <div class="invalid-feedback" v-if="errors.has('pb_name')">
                                    {{ errors.first('pb_name') }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="brandNameBengali" class="col-sm-3 col-lg-2 col-form-label">Brand Name (Bengali)</label>
                            <div class="col-sm-9 col-lg-10">
                                <input type="text" class="form-control" id="brandNameBengali" name="pb_name_bengali" v-validate="'max:30|min:2'" data-vv-as="Brand Name (Bengali)" data-vv-validate-on="keyup"
                                       :class="{'is-invalid' : errors.has('pb_name_bengali')}" v-model="newBrand.pb_name_bengali" placeholder="Enter Brand Name (Bengali)">

                                <div class="invalid-feedback" v-if="errors.has('pb_name_bengali')">
                                    {{ errors.first('pb_name_bengali') }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="brandWebsite" class="col-sm-3 col-lg-2 col-form-label">Website</label>
                            <div class="col-sm-9 col-lg-10">
                                <input type="text" class="form-control" id="brandWebsite" name="pb_website" v-validate="'max:150|min:6'" data-vv-as="Brand Website" data-vv-validate-on="keyup"
                                       :class="{'is-invalid' : errors.has('pb_website')}" v-model="newBrand.pb_website" placeholder="www.brand.com">

                                <div class="invalid-feedback" v-if="errors.has('pb_website')">
                                    {{ errors.first('pb_website') }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="brandPhone" class="col-sm-3 col-lg-2 col-form-label">Phone</label>
                            <div class="col-sm-9 col-lg-10">
                                <input type="text" class="form-control" id="brandPhone" name="pb_phone" v-validate="'max:15'" data-vv-as="Brand Phone" data-vv-validate-on="keyup"
                                       :class="{'is-invalid' : errors.has('pb_phone')}" v-model="newBrand.pb_phone" placeholder="+880 1619 229227">

                                <div class="invalid-feedback" v-if="errors.has('pb_phone')">
                                    {{ errors.first('pb_phone') }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="brandEmail" class="col-sm-3 col-lg-2 col-form-label">Email</label>
                            <div class="col-sm-9 col-lg-10">
                                <input type="email" class="form-control" id="brandEmail" name="pb_email" v-validate="'email|max:55'" data-vv-as="Brand Email" data-vv-validate-on="keyup"
                                       :class="{'is-invalid' : errors.has('pb_email')}" v-model="newBrand.pb_email" placeholder="support@brand.com">

                                <div class="invalid-feedback" v-if="errors.has('pb_email')">
                                    {{ errors.first('pb_email') }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row" v-if="!showAsModal">
                            <label for="brandImage" class="col-sm-3 col-lg-2 col-form-label">Image</label>
                            <div class="col-sm-9 col-lg-10">
                                <img src="/assets/images/category.png" style="max-width: 200px; padding: 25px;" :alt="newBrand.pb_name" v-if="newBrand.pb_img === '' || newBrand.pb_img === null">
                                <img :src="brandImagePreviewSrc" style="max-width: 200px; padding: 25px;" class="w-75 p-3 d-block" :alt="newBrand.pb_name" v-else>
                                <input id="brandImage" type="hidden" v-model="newBrand.pb_img">

                                <div class="text-center">
                                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#rbtMediaManager" v-if="showAddImageButton">
                                        <i class="fa fa-plus"></i> Add Image
                                    </button>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#rbtMediaManager" v-if="showChangeImageButton">
                                        Change Image
                                    </button>
                                    <button type="button" class="btn btn-danger" @click.prevent="removeImage" v-if="showRemoveImageButton">
                                        Remove Image
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-9 col-lg-10 offset-sm-3 offset-lg-2">
                                <button type="submit" class="btn btn-success">
                                    {{ (newBrand.pb_id === null) ? 'Add Brand' : 'Update Brand' }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <rbt-media-manager directory="main" :user_id="$root.admin.id" url_prefix="/bs-mm-api" show_as="modal" v-if="!showAsModal" @image-selected="imageSelected"></rbt-media-manager>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['brand_id', 'show_as'],
        data() {
            return {
                newBrand: {
                    pb_id: null,
                    pb_name: '',
                    pb_name_bengali: '',
                    pb_website: '',
                    pb_phone: '',
                    pb_email: '',
                    pb_img: ''
                },
                brandImagePreviewSrc: '',
                showAddImageButton: true,
                showChangeImageButton: false,
                showRemoveImageButton: false,
            }
        },
        methods: {
            updateBrand() {
                this.$validator.validate().then((result) => {
                    if(!result) {
                        return;
                    }
                    if(this.newBrand.pb_id === null) {
                        axios.post('/bs-admin-api/product-brands/create', this.newBrand)
                            .then((response) => {
                                this.newBrand.pb_id = response.data;
                                this.showToastMsg('Brand added successfully..!', 'success', 3000);
                                if(this.show_as === 'modal') {
                                    this.$emit('brand-added', this.newBrand);
                                    this.newBrand = {};
                                    $('#createProductBrandModal').modal('hide');
                                }
                            })
                            .catch((error) => {
                                this.handleServerErrors(error);
                            });
                    }
                    else {
                        axios.patch('/bs-admin-api/product-brands/update/' + this.newBrand.pb_id, this.newBrand)
                            .then((response) => {
                                this.showToastMsg('Brand updated successfully..!', 'success', 3000);
                            })
                            .catch((error) => {
                                this.handleServerErrors(error);
                            });
                    }
                });
            },
            imageSelected(image) {
                this.newBrand.pb_img = image.original;
                this.brandImagePreviewSrc = image.cache;
                this.showAddImageButton = false;
                this.showChangeImageButton = this.showRemoveImageButton = true;
            },
            removeImage() {
                this.newBrand.pb_img = '';
                this.brandImagePreviewSrc = '';
                this.showAddImageButton = true;
                this.showChangeImageButton = this.showRemoveImageButton = false;
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
        computed: {
            showAsModal() {
                if(this.show_as === undefined || this.show_as === 'page') {
                    return false;
                }
                else if(this.show_as === 'modal') {
                    return true;
                }
            }
        },
        created() {
            if(this.brand_id !== undefined) {
                this.newBrand.pb_id = this.brand_id;
                axios.get('/bs-admin-api/product-brands/' + this.brand_id)
                    .then((response) => {
                        this.newBrand = response.data;
                        if((response.data.pb_img === null || response.data.pb_img === '')) {
                            this.showAddImageButton = true;
                            this.showChangeImageButton = this.showRemoveImageButton = false;
                        }
                        else {
                            this.brandImagePreviewSrc = '/uploads/public/cache/large/' + response.data.pb_img;
                            this.showAddImageButton = false;
                            this.showChangeImageButton = this.showRemoveImageButton = true;
                        }
                    })
                    .catch((error) => {
                        this.handleServerErrors(error);
                    });
            }
        }
    }
</script>
