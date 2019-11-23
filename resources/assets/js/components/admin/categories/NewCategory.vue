<template>
    <div class="admin-new-category">
        <div class="card">
            <div class="card-header">
                <strong><i class="fa fa-plus"></i> Add</strong> Category
            </div>
            <div class="card-body">
                <form method="POST" id="addCategoryForm" accept-charset="UTF-8" @submit.prevent="addCategory">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="categoryTitle">Category Title:</label>
                                <input type="text" v-model="newCategory.category_title" v-validate="'required|max:70|min:5'" data-vv-validate-on="keyup" name="category_title" class="form-control"
                                       :class="{'is-invalid' : errors.has('category_title')}" id="categoryTitle" aria-describedby="categoryTitleHelp" placeholder="Category Title" autofocus>

                                <small id="categoryTitleHelp" class="form-text text-muted">The title is how it appears on your site.</small>
                                <div class="invalid-feedback" v-if="errors.has('category_title')">
                                    {{ errors.first('category_title') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="categoryTitleBangla">Category Title <span class="adorsho-lipi">(বাংলা)</span>:</label>
                                <input type="text" v-model="newCategory.category_title_bangla" data-vv-validate-on="keyup" name="category_title_bangla" class="form-control" id="categoryTitleBangla"
                                       :class="{'is-invalid' : errors.has('category_title_bangla') || serverSideErrors.category_title_bangla}" placeholder="ক্যাটাগরির নাম" v-validate="'min:5|max:70'" style="font-family: 'AdorshoLipi';">

                                <div class="invalid-feedback" v-if="errors.has('category_title_bangla') || serverSideErrors.category_title_bangla">
                                    {{ errors.first('category_title_bangla') || serverSideErrors.category_title_bangla[0] }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="categoryDescription">Category Description:</label>
                                <textarea v-model="newCategory.category_description" data-vv-validate-on="keyup" :class="{'is-invalid' : errors.has('category_description')}" name="category_description" v-validate="'required|min:50|max:255'" class="form-control" id="categoryDescription" rows="5" style="resize: none;"></textarea>

                                <div class="invalid-feedback" v-if="errors.has('category_description')">
                                    {{ errors.first('category_description') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="categoryType">Category Type:</label>
                                <select class="custom-select" :class="{'is-invalid' : errors.has('category_type')}"  v-validate="'required'" id="categoryType"
                                        name="category_type" data-vv-validate-on="click" v-model="newCategory.category_type">

                                    <option value="" selected>--- Select Category Type ---</option>
                                    <option value="parent">Parent</option>
                                    <option value="child">Child</option>
                                    <option value="filtering">Filtering</option>
                                </select>
                                <div class="invalid-feedback" v-if="errors.has('category_type')">
                                    {{ errors.first('category_type') }}
                                </div>
                            </div>

                            <div class="form-group" v-if="showSelectParent">
                                <label for="categoryParent">Category Parent:</label>
                                <select class="custom-select" :class="{'is-invalid' : errors.has('category_parent_id')}" v-if="newCategory.category_type === 'child'"
                                        v-validate="'required'" data-vv-validate-on="click" id="categoryParent" name="category_parent_id" v-model="newCategory.category_parent_id">

                                    <option value="" selected>--- Select Category Parent ---</option>
                                    <option v-for="item in selectParentData" :value="item.category_id">{{ item.category_title }}</option>
                                </select>

                                <select class="custom-select" :class="{'is-invalid' : errors.has('category_parent_id')}" v-if="newCategory.category_type === 'filtering'"
                                        v-validate="'required'" data-vv-validate-on="click" id="categoryParent" name="category_parent_id" v-model="newCategory.category_parent_id">
                                    <option value="" selected>--- Select Category Parent ---</option>
                                    <option v-for="item in selectParentData" :value="item.category_id" :disabled="item.category_type === 'parent'">
                                        {{ (item.category_type === 'parent')?  item.category_title : ('&emsp;&emsp;' + item.category_title) }}
                                    </option>
                                </select>

                                <div class="invalid-feedback" v-if="errors.has('category_parent_id')">
                                    {{ errors.first('category_parent_id') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Category Status: </label>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" class="custom-control-input" :value="1" v-model="newCategory.category_active">
                                    <label class="custom-control-label" for="customRadioInline1">Active</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" class="custom-control-input" :value="0" v-model="newCategory.category_active">
                                    <label class="custom-control-label" for="customRadioInline2">Inactive</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="categoryImage">Category Image:</label>
                                <div id="categoriesImageUploader">
                                    <img src="/assets/images/category.png" :alt="newCategory.category_title" v-if="newCategory.category_img === '' || newCategory.category_img === null">
                                    <img :src="categoryImagePreviewSrc" class="w-75 p-3 d-block" :alt="newCategory.category_title" v-else>
                                    <input id="categoryImage" type="hidden" v-model="newCategory.category_img">

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

                        </div>
                    </div>

                    <div class="rbt-form-button-container">
                        <button :disabled="!showAddButton" type="submit" class="btn btn-success">
                            {{ (this.category_id !== undefined && this.category_id !== NaN) ? 'Update Category' : 'Add Category' }}
                        </button>
                    </div>

                </form>

                <rbt-media-manager directory="main" :user_id="$root.admin.id" url_prefix="/bs-mm-api" show_as="modal" @image-selected="imageSelected"></rbt-media-manager>
            </div>
        </div>
    </div>
</template>

<script>

    import { Validator } from 'vee-validate';
    import AdminValidationDictionary from './../validation_dictionary/categories';
    Validator.localize(AdminValidationDictionary);

    export default {
        props: ['category_id'],
        data() {
            return {
                newCategory: {
                    category_title: '',
                    category_title_bangla: '',
                    category_description: '',
                    category_type: '',
                    category_parent_id: '',
                    category_order: '',
                    category_img: '' ,
                    category_active: 1
                },
                categoryImagePreviewSrc: '',
                showSelectParent: false,
                selectParentData: [ ],
                showAddImageButton: true,
                showChangeImageButton: false,
                showRemoveImageButton: false,
                serverSideErrors: [ ],
            }
        },

        methods: {
            selectParent(type) {
                axios.get('/bs-admin-api/categories/select-parent-for/' + type)
                    .then((response) => {
                        this.selectParentData = response.data;
                    })
                    .catch((error) => {

                    });
            },
            addCategory() {
                this.$validator.validate().then((result) => {
                    if (!result) {
                        this.enableAddButton = false;
                        return;
                    }
                });
                if(this.category_id === undefined) {
                    axios.post('/bs-admin-api/categories/add-new-cat', this.newCategory)
                        .then((response) => {
                            if(response.data === true) {
                                this.showToastMsg('Category added successfully', 'success', 3000);
                                Object.keys(this.newCategory).forEach((key) => {
                                    this.newCategory[key] = '';
                                });
                                this.serverSideErrors = [];
                                this.newCategory.category_active = 1;
                            }
                        })
                        .catch((error) => {
                            this.serverSideErrors = error.response.data.errors;
                            this.handleServerErrors(error);
                        });
                }
                else {
                    axios.patch('/bs-admin-api/categories/edit-cat/' + this.category_id, this.newCategory)
                        .then((response) => {
                            if(response.data === true) {
                                this.showToastMsg('Category updated successfully', 'success', 3000);
                                this.serverSideErrors = [];
                            }
                        })
                        .catch((error) => {
                            this.serverSideErrors = error.response.data.errors;
                            this.handleServerErrors(error);
                        });
                }
            },
            imageSelected(image) {
                this.newCategory.category_img = image.original;
                this.categoryImagePreviewSrc = image.cache;
                this.showAddImageButton = false;
                this.showChangeImageButton = this.showRemoveImageButton = true;
            },
            removeImage() {
                this.newCategory.category_img = '';
                this.categoryImagePreviewSrc = '';
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
                    this.showToastMsg(error.response.data.error, 'error', 5000);
                }
                else if(error.response.data.hasOwnProperty('errors')) {
                    let serverErrors = error.response.data.errors;
                    for(let err in serverErrors) {
                        if(serverErrors.hasOwnProperty(err)) {
                            self.showToastMsg(serverErrors[err], 'error', 5000);
                        }
                    }
                }
            }
        },
        watch: {
            'newCategory.category_type': function(newVal) {
                if(newVal === 'parent') {
                    this.selectParentData = {};
                    this.showSelectParent = false;
                }
                else if(newVal === 'child') {
                    this.selectParent('child');
                    this.showSelectParent = true;
                }
                else if(newVal === 'filtering') {
                    this.selectParent('filtering');
                    this.showSelectParent = true;
                }
                else {
                    this.selectParentData = {};
                    this.showSelectParent = false;
                }
            }
        },
        computed: {
            showAddButton() {
                if(this.category_id !== undefined || this.category_id !== NaN) {
                    return true;
                }
                if(Object.keys(this.fields).some(key => this.fields[key].invalid)) {
                    return false;
                }

                if(this.newCategory.category_type === 'parent') {
                    return true;
                }
                else if(this.newCategory.category_parent_id === '') {
                    return false;
                }
                return true;
            }
        },

        created() {
            if(this.category_id !== undefined && this.category_id !== NaN) {
                axios.get('/bs-admin-api/categories/single/' + this.category_id)
                    .then((response) => {
                        this.newCategory.category_title = response.data.category_title;
                        this.newCategory.category_title_bangla = response.data.category_title_bangla;
                        this.newCategory.category_description = response.data.category_description;
                        this.newCategory.category_type = response.data.category_type;
                        this.newCategory.category_parent_id = response.data.category_parent_id;
                        this.newCategory.category_order = response.data.category_order;
                        this.newCategory.category_img =  response.data.category_img;
                        this.newCategory.category_active = response.data.category_active;

                        if(response.data.category_img === null || response.data.category_img === '') {
                            this.showAddImageButton = true;
                            this.showChangeImageButton = this.showRemoveImageButton = false;
                        }
                        else {
                            this.categoryImagePreviewSrc = '/uploads/public/cache/large/' + response.data.category_img;
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
