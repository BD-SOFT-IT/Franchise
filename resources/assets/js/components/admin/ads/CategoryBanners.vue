<template>
    <div class="home-sliders">
        <div class="card">
            <div class="card-header">
                <strong><i class="fa fa-audio-description"></i> Home</strong> Sliders
            </div>
            <div class="card-body">
                <div class="select-category" style="margin: 15px 5%;">
                    <div class="form-group row justify-content-center">
                        <label for="category" class="col-form-label col-md-4 text-right">Category: </label>
                        <div class="col-md-8">
                            <select class="custom-select" id="category" v-model="selectedCategory" style="max-width: 350px;">
                                <option value="">Please Select A Category</option>
                                <option v-for="category in categories" :value="category.category_id">{{ category.category_title }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 30px;">#</th>
                            <th scope="col" style="text-align: center;">Image</th>
                            <th scope="col" style="text-align: center;">Details</th>
                            <th scope="col" class="text-center" style="width: 150px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(slider, index) in sliders">
                            <th scope="row" style="vertical-align: middle; width: 30px;">{{ index + 1 }}</th>
                            <td style="vertical-align: middle; text-align: center;">
                                <img class="index-slider-image" :src="'/uploads/public/cache/original/' + slider.banner_img" style="max-width: 350px; max-height: 200px; margin: 0 auto;"
                                     v-if="slider.banner_img !== null">
                                <img class="index-slider-image" :src="getImagePlaceHolder(slider.banner_name)" style="max-width: 350px; max-height: 200px; margin: 0 auto;"
                                     v-else>
                                <br>
                                <button type="button" class="btn btn-light mt-2" @click.prevent="selectImage(index)">Change</button>
                            </td>
                            <td style="vertical-align: middle;">
                                <div class="form-group" style="border: 0; padding: 0; margin-bottom: 5px;">
                                    <label :for="'banner_target_text' + index">Target Button Text</label>
                                    <input type="text" v-model="slider.banner_target_text" class="form-control" :id="'banner_target_text' + index" aria-describedby="banner_target_textHelp" placeholder="Button Text">
                                    <small id="banner_target_textHelp" class="form-text text-muted">Text inside the target button for the promotion.</small>
                                </div>

                                <div class="form-group" style="border: 0; padding: 0; margin-bottom: 5px;">
                                    <label :for="'banner_target_url' + index">Target URL</label>
                                    <input type="url" v-model="slider.banner_target_url" class="form-control" :id="'banner_target_url' + index" placeholder="https://domain.com/banner-target">
                                </div>

                                <div class="form-group" style="border: 0; padding: 0; margin-bottom: 5px;">
                                    <label for="banner_target_url_type">Target Destination</label> <br>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" :id="slider.banner_name + index" v-model="slider.banner_target_url_type" value="internal" :name="slider.banner_name" class="custom-control-input">
                                        <label class="custom-control-label" :for="slider.banner_name + index">Internal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" :id="slider.banner_name + (index + 1)" v-model="slider.banner_target_url_type" value="external" :name="slider.banner_name" class="custom-control-input">
                                        <label class="custom-control-label" :for="slider.banner_name + (index + 1)">External</label>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center; width: 150px;">
                                <button class="btn btn-light btn-outline-primary mt-3" @click.prevent="saveBanner(index)" style="width: 96px;">
                                    <i class="fa fa-save"></i> Save
                                </button>
                                <button class="btn btn-light btn-outline-danger mt-3" @click.prevent="removeBanner(index)" style="width: 96px;">
                                    <i class="fa fa-trash"></i> Reset
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <rbt-media-manager directory="banners" :user_id="$root.admin.id" url_prefix="/bs-mm-api" show_as="modal" @image-selected="imageSelected"></rbt-media-manager>
    </div>
</template>

<script>
    export default {
        props: ['api', 'categories'],
        data() {
            return {
                sliders: [],

                indexForChange: null,
                selectedCategory: null
            }
        },
        methods: {
            getSliders() {
                axios.get(this.api + '/' + this.selectedCategory)
                    .then((response) => {
                        console.log(response.data);
                        this.sliders = response.data;
                    })
                    .catch((error) => {

                    })
            },
            selectImage(index) {
                this.indexForChange = index;
                $('#rbtMediaManager').modal('show');
            },
            saveBanner(index) {
                axios.post(this.api, this.sliders[index])
                    .then((response) => {
                        this.showToastMsg(response.data.status, 'success');
                    })
                    .catch((error) => {
                        if(error.response.status === 422 && error.response.data.invalid) {
                            this.showToastMsg(error.response.data.invalid, 'error', 3500);
                        } else if(error.response.status === 500) {
                            this.showToastMsg('Something went wrong!', 'error', 3500);
                        }
                    })
            },
            removeBanner(index) {
                this.sliders[index].banner_img = this.sliders[index].banner_target_text = this.sliders[index].banner_target_url =this.sliders[index].banner_target_url_type =  null;
            },
            imageSelected(image) {
                this.sliders[this.indexForChange].banner_img = image.original;
                this.indexForChange = null;
            },
            updateSliders() {
                axios.post(this.api, this.bannerChanges)
                    .then((response) => {
                        this.showToastMsg(response.data.status, 'success')
                    })
                    .catch((error) => {

                    })
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
            getImagePlaceHolder(name) {
                if(name.startsWith('category_sidebar')) {
                    return 'https://via.placeholder.com/300x490?text=(300x490+px)';
                } else if(name.startsWith('category_page')) {
                    return 'https://via.placeholder.com/870x220?text=(870x220+px)';
                }
                else {
                    return 'https://via.placeholder.com/850x140?text=(850x140+px)';
                }
            }
        },
        watch: {
            selectedCategory(newVal, oldVal) {
                this.sliders = [];
                if(parseInt(newVal) !== parseInt(oldVal)) {
                    this.getSliders();
                }
            }
        },
        created() {
            if(this.categories) {
                this.selectedCategory = this.categories[0].category_id;
                this.getSliders();
            }
        }
    }
</script>

<style lang="scss">
    @media screen and (max-width: 992px) {
        .index-slider-image {
            max-width: 200px !important;
        }
    }
</style>
